<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $featuredProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }
}
