<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Edit extends Controller
{
    public function index(Post $post){
        return view('edit', ['post'=>$post]);
    }

    public function update(Post $post, Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'media'=>'required',
        ]);

        $post->update($request->all());

        if(isset($request->added_media)){
            foreach($request->added_media as $image){
            
                $from = public_path('tmp/uploads/'.$image);
                $to = public_path('post_images/'.$image);
                
                File::move($from, $to);
                $post->images()->create([
                    'name' => $image,
                ]);
            }
        }
        
        if(isset($request->deleted_media)){
            foreach($request->deleted_media as $deleted_media){
                File::delete(public_path('post_images/'.$deleted_media));
                Image::where('name', $deleted_media)->delete();
            }
        }
        
        $posts = Post::get();
        return redirect()->route('post.dashboard', ['posts'=>$posts]);

    }
}
