<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Section;
use Validator;
use Session;
use Image;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page','products');
        $products =Product::with(['category'=>function($query){
            $query->select('id','category_name');
        },'section'=>function($query){
            $query->select('id','name');
        }])->get();    
        // $products=json_decode(json_encode($products));
        // dd($products);
        return view('admin.product.products')->with(compact('products'));
    }

    public function UpdateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data=$request->all();
             if($data['status'] =='Active'){
                 $status = 0;
             }else{
                 $status = 1;
             }
             Product::where('id',$data['product_id'])->update(['status' =>$status]);
             return response()->json(['status'=>$status,'product_id' =>$data['product_id']]);
        }

    }
    public function deleteProduct($id)
    {
          Product::where('id',$id)->delete();
        $message='product  successfully delete';
        Session::flash('success_message',$message);
        return redirect()->back();

    }

    public function addeditproduct(Request $request,$id=null)
    {
        if($id=="")
        {
            $title="Add Product";
            $productdata=array();
            $product = new Product;
            $message="product added sucessfully";

        }else{
            $title="Edit Product";
            $productdata=Product::find($id);
            $productdata=json_decode(($productdata),true);
            $product = Product::find($id);
            $message="product updated sucessfully";
            // dd($productdata);
        }
        if($request->isMethod('post')){
            $data=$request->all();
            // dd($data);

            //Product Validations

            $rules =[
                'category_id' =>'required',
                'product_name' =>'required|regex:/^[\pL\s\-]+$/u',
                'product_code' =>'required|regex:/^[\w-]*$/',
                'product_price'=>'required|numeric',
                'product_color'=>'required|regex:/^[\pL\s\-]+$/u'
               
            ];
            $customeMessages =[
                'category_id.required' => 'Category  is required',
                'product_name.required' =>'product Name is required',
                'product_name.regex' =>'Valid Product Name is Required',
                'product_code.required' =>'product Code is required',
                'product_code.regex' =>'Valid product code is required',
                'product_price.required'=>'product Price is required',
                'product_price.numeric' =>'Valid product price is required',
                'product_color.required'=>'product color is required',
                'product_color.regex'=>'Valid product color is required',
               
            ];
            $this->validate($request,$rules,$customeMessages);
            if(empty($data['is_featured'])){
                $is_featured = "No";
            }else{
                $is_featured= "Yes";
            }
            if(empty($data['fabric'])){
                $data['fabric']="";
            }
            if(empty($data['pattern'])){
                $data['pattern']="";
            }
            if(empty($data['sleeve'])){
                $data['sleeve']="";
            }
            if(empty($data['fit'])){
                $data['fit']="";
            }
            if(empty($data['occasion'])){
                $data['occasion']="";
            }
            if(empty($data['meta_title'])){
                $data['meta_title']="";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']="";
            }
            if(empty($data['meta_description'])){
                $data['meta_description']="";
            }


            //Upload Product image

            if($request->hasFile('main_image')){
                $image_tmp=$request->file('main_image');
                if($image_tmp->isValid()){
                    //Upload Images after Resize

                    $image_name=$image_tmp->getClientOriginalName();

                    $extension=$image_tmp->getClientOriginalName();
                    //generate new image name
                    $imageName=$image_name.'-'.rand(111,99999).'.'.$extension;
                    $large_image_path ='images/products_images/large/'.$imageName;
                    $medium_image_path ='images/products_images/medium/'.$imageName;
                    $small_image_path ='images/products_images/small/'.$imageName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    $product->main_image=$imageName;
                }
            }


            //Upload Product Video
            if($request->hasFile('product_video')){
                $video_tmp=$request->file('product_video');
                if($video_tmp->isValid()){
                    //Upload Video
                    $video_name=$video_tmp->getClientOriginalName();
                    $extension=$video_tmp->getClientOriginalName();
                    $videoName=$video_name.'-'.rand().'.'.$extension;
                    $video_path='videos/products_video/';
                    $video_tmp->move($video_path,$videoName);
                    //Save Video in Products table
                    $product->product_video=$videoName;
                }
            }
            

            //Save Product details
            $categoryDetails =Category::find($data['category_id']);
            $product->section_id=$categoryDetails['section_id'];
            $product->category_id=$data['category_id'];
            $product->product_name =$data['product_name'];
            $product->product_price =$data['product_price'];
            $product->product_code =$data['product_code'];
            $product->product_color =$data['product_color'];
            $product->product_discount =$data['product_discount'];
            // $product->product_video =$data['product_video'];
            $product->product_weight =$data['product_weight'];
            $product->description =$data['description'];
            $product->wash_care= $data['wash_care'];
            $product->fabric =$data['fabric'];
            $product->pattern =$data['pattern'];
            $product->sleeve =$data['sleeve'];
            $product->fit =$data['fit'];
            $product->occassion =$data['occassion'];
            $product->meta_title =$data['meta_title'];
            $product->meta_keywords =$data['meta_keywords'];
            $product->meta_description =$data['meta_description'];
            $product->is_featured=$is_featured;
            $product->status=1;
            $product->save();
            Session::flash('success_message',$message);
            return redirect('admin/Products');
        }
            //Filter Array
        $fabricArray = array('Cotton','Polyester','Wool');
        $sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless');
        $patternArray = array('Checked','Plain','Printed','Self','Solid');
        $fitArray = array('Regular','Slim');
        $occassionArray = array('Casual','Formal','Wool');

        //Sections with Categories and Sub categories
        $categories=Section::with('categories')->get();
        // $categories=json_decode(json_encode($categories),true);
        // dd($categories);

        return view('admin.product.add_edit_product')->with(compact('title','fabricArray','sleeveArray','patternArray','fitArray','occassionArray','categories','productdata'));

    }
}
