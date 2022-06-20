<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategory(){
        $categories = Category::latest() -> get();
        return response() -> json([
            'categories' => $categories
        ], 200);
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'cat_name' => 'required | min:2 | max:30'
        ]);

        Category::create([
            'cat_name' => $request -> cat_name
        ]);
    }

    public function deleteCategory($id){
       $category_delete = Category::find($id);
       $category_delete -> delete();
    }

    public function editCategory($id){
        $category = Category::find($id);
        return response() -> json([
            'category' => $category
        ], 200);
    }

    public function updateCategory(Request $request, $id){
        $update_id = Category::find($id);
        $this -> validate($request, [
            'cat_name' => 'required | min:2 | max:30'
        ]);

        $update_id -> cat_name = $request -> cat_name;
        $update_id -> update();
    }

    public function selectedCategoryDelete($ids){
        $values = explode(',', $ids);
        foreach($values as $category){
            $category_info = Category::find($category);
            $category_info -> delete();
        }
    }
}
