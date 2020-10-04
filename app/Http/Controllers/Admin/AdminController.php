<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Admin;
use Session;
use Image;  

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }
    public function settings()
    {
    //    echo'<pre>';print_r(Auth::guard('admin')->user());die;
       Session::put('page','settings');
       $adminDetails =Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }
    public function login(Request $request)
    {
        // echo $password = Hash::make('123456'); die;
        if($request->isMethod('post')){
            $data= $request->all();
            // echo '<pre>';print_r($data);

            // $validatedData = $request->validate([
            //     'email' => 'required|email|max:255',
            //     'password' => 'required',
            // ]);
             $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
             ];
            $customeMessages = [
               'email.required' =>'Email is required',
               'email.email' =>'Valid Email is required',
               'password.required' =>'password is required',
            ];
            $this->validate($request,$rules,$customeMessages);


            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                  return redirect('admin/dashboard');
            }else{
                Session::flash('error_message','Invalid Email Or Password');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
    public function checkcurrentpassword(Request $request)
    {
        $data =$request->all();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";   
        }
    
    }
    public function updatecurrentpassword(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            // echo "<pre>";print_r($data);die;   
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password))
            {
                if($data['new_pwd']== $data['confirm_pwd']){
                   Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                   Session::flash('success_message','Password has been Updated Successfully');
                }else{
                    Session::flash('error_message','New password and Confirmation Not match');  
                   
                }
            }else{
              Session::flash('error_message','Your Current Password is incorrect');  
             return redirect()->back();
            }
            return redirect()->back();
        }

    }

    public function UpdateAdminDetails(Request $request)
    {
        Session::put('page','update-admin-details');
        if($request->isMethod('post')){
            $data=$request->all();
            // echo '<pre>';print_r($data);die;
            $rules =[
                'admin_name' =>'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' =>'required|numeric',
                'admin_image' =>'image|mimes:jpeg,png,jpg,gif,svg,PNG'
            ];
            $customeMessages =[
                'admin_name.required' => 'Name is required',
                'admin_name.regex' =>'Valid Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid Mobile is required',
                'admin_image.image' => 'Valid image is required',
            ];
            $this->validate($request,$rules,$customeMessages);
             //Upload Image
           if($request->hasFile('admin_image')){
               $image_tmp =$request->file('admin_image');
               if($image_tmp->isValid()){
                   //Get Image Extension
                   $extension =$image_tmp->getClientOriginalExtension();
                   //Generate New Image Name
                   $imageName = rand(111,99999).'.'.$extension;
                   $imagePath ='images/admin_images/admin_photos'.$imageName;
                   Image::make($image_tmp)->resize(300,400)->save($imagePath);
               }else if(!empty($data['current_admin_image'])){
                   $imageName =$data['current_admin_image'];
               }else{
                   $imageName ="";  
               }
           } 
            Admin::where('email',Auth::guard('admin')->user()->email)->update(['name' =>$data['admin_name'],'mobile'=>$data['admin_mobile'],'image' =>$imageName]);
            session::flash('success_message','Admin details Updated Successfully');
            return redirect()->back();
        }
        return view('admin.update_admin_details');
    }
}
