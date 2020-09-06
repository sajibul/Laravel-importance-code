<?php 

//user image update 

    $user=User::findOrFail(Auth::id());
        $image=$request->file('user_picture');

          if(isset($image)){

            $imageName='user_image_'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }
            if(Storage::disk('public')->exists('profile/'.$user->user_picture)){
                Storage::disk('public')->delete('profile/'.$user->user_picture);
            }
            Image::make($image)->resize(500,500)->save(public_path('storage/profile/'.$imageName));
          }else{
            $imageName=$user->user_picture;
          }

//end update user image


//insert image 

  if($request->hasFile('picture')){
        $image=$request->file('picture');
        $imageName='post_image-'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
        if(!Storage::disk('public')->exists('postimage')){
            Storage::disk('public')->makeDirectory('postimage');
        }
        Image::make($image)->resize(500,479)->save(public_path('storage/postimage/'.$imageName));
      }else{
        $imageName="default.png";
      }

//end insert image


//upate image in post 


  $postInfo=Post::findOrFail($id);
          $image=$request->file('picture');
          if(isset($image)){

            $imageName='post_image-update'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('postimage')){
                Storage::disk('public')->makeDirectory('postimage');
            }
            if(Storage::disk('public')->exists('postimage/'.$postInfo->post_image)){
                Storage::disk('public')->delete('postimage/'.$postInfo->post_image);
            }
            Image::make($image)->resize(500,479)->save(public_path('storage/postimage/'.$imageName));
          }else{
            $imageName=$postInfo->post_image;
          }

?>