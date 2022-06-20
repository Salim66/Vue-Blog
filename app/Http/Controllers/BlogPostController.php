<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function allBlogPost(){
        $posts = Post::with('user', 'category')->latest()->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function singleBlogPost($id){
        $post = Post::with('user', 'category')->where('id', $id)->first();
        return response()->json([
            'post' => $post
        ], 200);
    }

    public function allPostCategory(){
        $categories = Category::latest() -> get();
        return response() -> json([
            'categories' => $categories
        ], 200);
    }

    public function singleCategoryPost($id){
        $posts = Post::with('user', 'category')->where('cat_id', $id)->latest()->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function latestPost(){
        $posts = Post::with('user', 'category')->latest()->get();
        return response()->json([
            'posts' => $posts
        ], 200);
    }

    public function realSearchByPost(){
        $search = \Request::get('s');
        if($search != null){
            $posts = Post::with('user', 'category')->where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%')->get();
            return response() -> json([
                'posts' => $posts
            ], 200);
        }else{
            return $this -> allBlogPost();
        }
    }
}
