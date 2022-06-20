<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostController extends Controller
{
    public function allPost(){
        $posts = Post::with('user', 'category') -> latest() -> get();
        return response() -> json([
            'posts' => $posts
        ], 200);
    }

    public function addPost(Request $request){

        $this -> validate($request, [
            'title' => 'required | min:2 | max:100',
            'description' => 'required | min:2 | max:5000',
        ]);

        $strpos = strpos($request->photo, ';');
        $strsub = substr($request->photo, 0, $strpos);
        $explode = explode('/', $strsub)[1];
        $name = time().'.'.$explode;
        $image = Image::make($request->photo)->resize(800, 400);
        $upload_path = public_path().'/uploadimage/';
        $image -> save($upload_path.$name);

        Post::create([
            'title' => $request -> title,
            'description' => $request -> description,
            'cat_id' => $request -> cat_id,
            'user_id' => Auth::user() -> id,
            'photo' => $name,
        ]);
    }

    public function deletePost($id){
        $delete_post = Post::find($id);
        $delete_post -> delete();
        if(file_exists('uploadimage/'.$delete_post->photo)){
            unlink('uploadimage/'.$delete_post->photo);
        }
    }

    public function editPost($id){
        $post = Post::with('user', 'category') -> where('id', $id) -> first();
        return response() -> json([
            'post' => $post
        ], 200);
    }

    public function updatePost(Request $request, $id){
        $update_post = Post::find($id);

        $this -> validate($request, [
            'title' => 'required | min:2 | max:100',
            'description' => 'required | min:2 | max:5000',
        ]);

        if($update_post->photo != $request->photo){
            $strpos = strpos($request->photo, ';');
            $substr = substr($request->photo, 0, $strpos);
            $explode = explode('/', $substr)[1];
            $name = time().'.'.$explode;
            $image = Image::make($request->photo)->resize(800, 400);
            $upload_path = public_path().'/uploadimage/';
            $image -> save($upload_path.$name);
            if(file_exists('uploadimage/'.$update_post->photo)){
                unlink('uploadimage/'.$update_post->photo);
            }
        }else{
            $name = $update_post->photo;
        }

        $update_post -> title = $request -> title;
        $update_post -> description = $request -> description;
        $update_post -> cat_id = $request -> cat_id;
        $update_post -> user_id = Auth::user() -> id;
        $update_post -> photo = $name;
        $update_post -> update();
    }

    public function selectedPostDeleted($ids){
        $values = explode(',', $ids);
        foreach($values as $id){
            $post = Post::find($id);
            $post -> delete();
            if(file_exists('uploadimage/'.$post->photo)){
                unlink('uploadimage/'.$post->photo);
            }
        }

    }
}
