<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $selectedCategory = request('category');

        $products = Product::query()
            ->when(in_array($selectedCategory, ['men', 'women']), function ($query) use ($selectedCategory) {
                $query->where('category', $selectedCategory);
            })
            ->latest()
            ->get();

        return view('products.index', compact('products', 'selectedCategory'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('products.index');
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

}
