<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Session;
use Image;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page','categories');
        $categories =Category::with('section','parentcategory')->get();
    //     $categories=json_decode(json_encode($categories));
    //    dd($categories);
        return view('admin.categories.categories')->with(compact('categories'));
    }
    public function UpdateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data=$request->all();
             if($data['status'] =='Active'){
                 $status = 0;
             }else{
                 $status = 1;
             }
             Category::where('id',$data['category_id'])->update(['status' =>$status]);
             return response()->json(['status'=>$status,'category_id' =>$data['category_id']]);
        }

    }


    public function addeditcategory(Request $request, $id=null)
    {
       
         if($id="")
         {
            $title ="Add Category";
            $category =new Category;
            $categorydata=array();
            $getCategories=array();
            $message ="Category added Sucessfully!";

         }else{
             $title="Edit Category";
             $categorydata=Category::where('id',$id)->first();
             $categorydata=json_decode(json_encode($categorydata));
                       //  dd($categorydata); 
             $getCategories=Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categorydata['section_id']])->get();
             $getCategories=json_decode(json_encode($getCategories),true);
            //  dd($getCategories);
            $category =Category::find($id);
            $message ="Category Updated Sucessfully!";

  
         }

         if($request->isMethod('post')){
               $data=$request->all();
               $category =new Category;

               $rules =[
                'category_name' =>'required|regex:/^[\pL\s\-]+$/u',
                'section_id' =>'required',
                'url' =>'required',
                'category_image' =>'image|mimes:jpeg,png,jpg,gif,svg,PNG'
            ];
            $customeMessages =[
                'category_name.required' => 'Category Name is required',
                'category_name.regex' =>'Valid Name is required',
                'section_id.required' => 'section is required',
                'url.required' => 'Category Url is required',
                'category_image.image' => 'Valid image is required',
            ];
            $this->validate($request,$rules,$customeMessages);


          if($request->hasFile('category_image')){
                $image_tmp =$request->file('category_image');
                if($image_tmp->isValid()){
                    //Get Image Extension
                    $extension =$image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath ='images/category_images'.$imageName;
                    Image::make($image_tmp)->resize(300,400)->save($imagePath);
                    //save Category Image
                    $category->category_image =$imageName;
                }
            }
            
            if(empty($data['category_discount'])){
                 $data['category_discount']= '';
            }
            if(empty($data['description'])){
                $data['description']= '';
           }
           if(empty($data['meta_title'])){
            $data['meta_title']= '';
           }
           if(empty($data['meta_keywords'])){
            $data['meta_keywords']= '';
           }
           if(empty($data['meta_description'])){
            $data['meta_description']= '';
           }

                //  dd($category);
            $category->parent_id = $data['parent_id'];
            $category->section_id =$data['section_id'];
            $category->category_name =$data['category_name'];
            // $category->category_image =$data['category_image'];
            $category->category_discount =$data['category_discount'];
            $category->description =$data['description'];
            $category->url =$data['url'];
            $category->meta_title =$data['meta_title'];
            $category->meta_description =$data['meta_description'];
            $category->meta_keywords =$data['meta_keywords'];
            $category->status =1;
             $category->save();
             Session::flash('success_message',$message);
             return redirect('admin/categories');
         }

         //Get All Sections
         $getSections = Section::get();
         return view('admin.categories.add_edit_category')->with(compact('title','getSections','categorydata','getCategories'));
    }

    public function appendCategoryLevel(Request $request)
    {
        if($request->ajax()){
            $data=$request->all();
          $getCategories =Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
          $getCategories=json_decode(json_encode($getCategories),true);
        //   dd($getCategories);
         return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }

    }
    public function deletecategory($id)
    {
        Category::where('id',$id)->delete();
        $message='category has been delete sucessfully';
        Session::flash('success_message',$message);
        return redirect()->back();

    }
}
