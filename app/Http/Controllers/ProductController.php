<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view("products.index",["products"=>$products]);
    }
    //
    public function create(){
        return view("products.create");
    }
    //
    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        
        $newProduct = Product::create($data);
        return redirect(route('product.index'));
    }
    //
    public function edit(Product $product){     
        return view('products.edit',['product'=>$product]);
    }
    //
    public function update(Product $product, Request $request){     
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $product->update($data);
        return redirect(route('product.index'))->with('success','nice');
    }
    //
    public function destroy(Product $product){     
        $product->delete();
        return redirect(route('product.index'))->with('success','Successful deletion');
    }
    //


}
