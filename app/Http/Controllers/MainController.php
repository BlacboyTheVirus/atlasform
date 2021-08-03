<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class MainController extends Controller
{
   public function login(){
      return view('auth.login');
   }

   public function register(){
      return view('auth.register');
   }

   public function save(Request $request){
      
      //validate request
      $request->validate([
         'name'=> 'required',
         'vendor_code'=> 'required|unique:vendors',
         'email'=> 'required|email|unique:vendors',
         // 'password'=> 'required|min:6|max:12',
      ]);

      //insert Vendors
      $vendor = new Vendor;
      $vendor->name = $request->name;
      $vendor->vendor_code = $request->vendor_code;
      $vendor->email = $request->email;
      $vendor->password = Hash::make($request->password);
      $save = $vendor->save();

      if ($save){
         return back()->with('success', 'New Vendor has been successfully created.');
      } else {
         return back()->with('fail', 'Something didn\'t go right');
      }
   }


   public function check(Request $request){
      //validate Requests
      $request->validate([
         'email'=>'required|email',
         // 'password' => 'required|min:6|max:12'
      ]);

      $vendorinfo = Vendor::where('email', '=', $request->email)->first();

      if(!$vendorinfo){
         return back()->with('fail', 'We do not recognize your email!');
      } else {
         //login
         $request->session()->put('LoggedVendor', $vendorinfo->id);
         return redirect('/form');
      }


   }



   public function logout(){
      if(session()->has('LoggedVendor')){
         session()->pull('LoggedVendor');
         return redirect('auth/login');
      }
   }


 

}
