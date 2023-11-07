<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Function for create categories
    public function storeCategory(Request $request)
    {
        // Validation input required
        $validator = Validator::make($request->all(),
        [
            'meta_title' => ['required', 'string', 'max:200'],
            'slug'       => ['required', 'string', 'max:200'],
            'name'       => ['required', 'string', 'max:200'],
        ]);
        // test validator
        if ($validator->fails())
        {
            return response()->json([
                "status"  => 400,
                "message" => "Invalid data",
                'errors'  =>$validator->getMessageBag(),
            ]);
        }
        else
        {
            $category = new Category();
            $category->name         = $request->input('name');
            $category->slug         = $request->input('slug');
            $category->desription   = $request->input('description');
            $category->status       = $request->input('status') == true ?  '1' : '0';
            $category->meta_title   = $request->input('meta_title');
            $category->meta_ceywords    = $request->input('meta_ceywords');
            $category->meta_description = $request->input('meta_description');
            $category->save();

            return response()->json(([
                'status' => 200,
                'message'=> 'Category Added successfully'
            ]));
        }

    }

    // function for view category
    public function viewCategory()
    {
        $category = Category::all();
        return response()->json([
            'status'   => 200,
            'category' => $category
        ]);

    }


}
