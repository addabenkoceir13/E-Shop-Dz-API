<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Function for create categories
    public function storeCategories(Request $request)
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
            $category->description  = $request->input('description');
            $category->status       =  $request->has('status') ? 1 : 0;
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
    public function viewCategories()
    {
        $category = Category::all();
        return response()->json([
            'status'   => 200,
            'category' => $category
        ]);

    }

    // function for view edit category
    public function editCategories(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message'=> 'No Categories Found'
            ]);

        }
    }

    // function for upddate category
    public function updateCategories(Request $request ,$id)
    {
        // Validation input required
        $validator = Validator::make($request->all(),
        [
            'meta_title' => ['required', 'string', 'max:200'],
            'slug'       => ['required', 'string', 'max:200'],
            'name'       => ['required', 'string', 'max:200'],
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors'=>$validator->getMessageBag()
            ]);
        }
        else
        {
            $category = Category::find($id);
            if ($category)
            {
                $category->name               =   $request->input('name');
                $category->slug               =   $request->input('slug');
                $category->description        =   $request->input('description');
                $category->status             =   $request->has('status') ? 1 : 0;
                $category->meta_title         =   $request->input('meta_title');
                $category->meta_ceywords      =   $request->input('meta_ceywords');
                $category->meta_description   =   $request->input('meta_description');
                $category->save();

                return response()->json([
                    'status' => 200,
                    'message'=> 'Updated Successfully'
                    ]);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message'=> 'Category Not Found'
                ]);
            }
        }
    }

    // function for deleted category
    public function deletedCategories($id)
    {
        $category = Category::find($id);
        if ($category)
        {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message'=> 'Category Deleted Successfully'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message'=> 'Category Not Found'
            ]);
        }

    }

    // function for all category
    public function AllCategories()
    {
        $categories = Category::all();
        if ($categories) {
            return response()->json([
                'status' => 200,
                'categories'=>$categories
            ]);
        }
        else {
            return response()->json([
                'status' => 404,
                'message'=> 'No Categories Found'
                ]);
        }
    }











}
