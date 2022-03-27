<?php

namespace App\Http\Controllers\PostController;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Create extends Controller
{
    public function index(){
        return view('create');
    }

    public function store(Request $request){
        
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'media'=>'required',
        ]);
        $post = Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        
        foreach($request->media as $image){
            
            $from = public_path('tmp/uploads/'.$image);
            $to = public_path('post_images/'.$image);
            
            File::move($from, $to);
            $post->images()->create([
                'name' => $image,
            ]);
        }

        $posts = Post::get();
        return redirect()->route('post.dashboard', ['posts'=>$posts]);
    }
}
