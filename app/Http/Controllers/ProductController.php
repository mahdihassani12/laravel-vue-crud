<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->toArray();
        return array_reverse($products);      
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $destinationPath = 'public/uploads/';

        $product = New Product();
        $product -> name = $request->name;
        $product -> detail = $request->detail;

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $image->move($destinationPath, $imageName); 

        $product->image = $imageName;
        $product->path = $destinationPath;

        $product->save();
        return response()->json('Product created!');
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    public function update($id, Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $destinationPath = 'public/uploads/';

        $product = Product::find($id);
        $product -> name = $request->name;
        $product -> detail = $request->detail;

        if($request->file('image')){

            $currentPhoto = $product->image;
            $userPhoto = public_path('public/uploads/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $product->image = $imageName;
            $product->path = $destinationPath;

        } 

        $product->save();
        return response()->json('Product created!');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product deleted!');
    }
}
