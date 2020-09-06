<?php 

//user in controller 
use Storage;
use Image;
use Auth;
use Hash;

//this code for controller 

$this->validate($request,[
        'old_password'=>'required',
        'password'=>'required|confirmed',
      ],[

      ]);


      $haspassword=Auth::user()->password;
      if(Hash::check($request->old_password,$haspassword)){

         if(!Hash::check($request->password,$haspassword)){
            $user=User::findOrFail(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Toastr::info('Success', 'User password update success');
            Auth::logout();
            return back();
         }else {
           Toastr::Error('Error', 'New password can not be same as old password','Error');
           return back();
         }
      }else {
        Toastr::danger('Error', 'Current password does not match');
        return back();
      }




?>