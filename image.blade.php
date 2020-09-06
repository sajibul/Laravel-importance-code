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

//multipule image insert

    if($request->hasFile('picture')){
        $image=$request->file('picture');
        $imageName='Category_image-'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
        if(!Storage::disk('public')->exists('category/image')){
            Storage::disk('public')->makeDirectory('category/image');
        }
        Image::make($image)->resize(1600,479)->save(public_path('storage/category/image/'.$imageName));

        if(!Storage::disk('public')->exists('category/banner')){
            Storage::disk('public')->makeDirectory('category/banner');
        }
        Image::make($image)->resize(500,333)->save(public_path('storage/category/banner/'.$imageName));
      }else{
        $imageName="default.png";
      }

//multiple images
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




//
?>