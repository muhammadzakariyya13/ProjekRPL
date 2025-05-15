<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $expensiveProducts = Product::expensive()->get();
        $averagePrice = Product::averagePrice();
        return view('products.index', compact('products', 'expensiveProducts', 'averagePrice'));

    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' =>'required',
            'description' =>'nullable|string',
            'price' =>'required|numeric',
            'stock' =>'required|integer',
        ]);

        Product::create($request->all());
        return redirect('/products')->with('success', 'product added succefully!');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' =>'required',
            'description' =>'nullable|string',
            'price' =>'required|numeric',
            'stock' =>'required|integer'
        ]);
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product updated successfully!');
    }
}
