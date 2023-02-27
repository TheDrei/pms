<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function delete($name)
    {
        category::where('name', $name)->delete();
        //category::find($name)->delete();
        return Redirect::route('admin/library/all');
    }

    public function store(Request $request)
    {
        try
        {
          $categories = new App\Category;
    
          $categories->cat_desc = $request->cat_desc;
          $categories->save();
          $category_id = $category->id;

          return redirect('admin/library/all');
        } catch(Exception $e)
        {
          return "ERROR";
        }
    }
}
