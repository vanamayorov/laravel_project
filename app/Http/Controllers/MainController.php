<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $productsQuery = Product::with('category');
        $products = $productsQuery->paginate(6);
        return view('index', compact('products'));
    }
    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }
    public function category($categoryCode)
    {
        $category = Category::where('code', $categoryCode)->first();
        return view('category', compact('category'));
    }
    public function product($category, $productCode = null)
    {
        $product = Product::where('code', $productCode)->first();
        return view('product_details', compact('product'));
    }
}
