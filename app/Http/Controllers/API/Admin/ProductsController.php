<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\images;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Uploads\UploadsPhotos ;
// use Illuminate\Http\FileHelpers::extension;

class ProductsController extends Controller
{
    use UploadsPhotos;
    //
    public function AddProducts(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'qty'           => 'required|numeric',
            'category_id'   => 'required',
            'name'          => 'required|max:255',
            'slug'          => 'required|max:255',
            'meta_title'    => 'required|max:255',
            'description'   => 'required',
            'meta_keyword'  => 'required',
            'meta_description'  => 'required',
            'selling_price'     => 'required',
            'original_price'    => 'required|numeric',
            'brand'             => 'required|max:255',
            'image'             => 'required|image',
        ]);


        if ($validator->fails())
        {
            return response()->json([
                'status'  => 422,
                'message' => 'The input are empty',
                'errors'  => $validator->getMessageBag()
            ]);
        }
        else
        {
            $category_id = $request->input('category_id');
            $categoryExist = Category::find($category_id);

            if ($categoryExist) {
                $products = new Products();
                $products->category_id  = $category_id;
                $products->name         = $request->input('name');
                $products->slug         = $request->input('slug');
                $products->description  = $request->input('description');
                $products->meta_title   = $request->input('meta_title');
                $products->meta_keyword = $request->input('meta_keyword');
                $products->meta_description = $request->input('meta_description');
                $products->selling_price    = $request->input('selling_price');
                $products->original_price   = $request->input('original_price');
                $products->qty      = $request->input('qty');
                $products->brand    = $request->input('brand');
                $products->featured = $request->input('featured') == true ? 1 : 0;
                $products->popular  = $request->input('popular') == true ? 1 : 0;
                $products->status   = $request->input('status') == true ? 1 : 0;
                $products->image    = $request->input('image');
                if ($request->hasFile('image'))
                {
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('uploads/admin/products/',$filename);
                    $products->image = 'uploads/admin/products/'.$filename;
                }
                $products->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Products Added Successfully'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 401,
                    'message'=> 'Category not found.'
                ]);
            }
        }
    }

    public function imageUpload(Request $request)
    {
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move(public_path('uploads/admin/products/'), $filename);

            $images = new images();
            $images->product_id = 1;
            $images->image      = $filename;
            $images->save();

            return response()->json([
                'status' => 200,
                'message'=> 'This image has'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 400,
                'message'=> 'This image Not Find'
            ]);
        }
    }
}
