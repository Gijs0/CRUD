<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $products = $query->paginate(12);
        $categories = Category::all();
        
        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required',
            'color' => 'required',
            'image' => 'nullable|image|max:2048',
            'sku' => 'required|unique:products,sku'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);
        
        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product succesvol toegevoegd!');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required',
            'color' => 'required',
            'image' => 'nullable|image|max:2048',
            'sku' => 'required|unique:products,sku,' . $product->id
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);
        
        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product succesvol bijgewerkt!');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        
        return redirect()
            ->route('products.index')
            ->with('success', 'Product succesvol verwijderd!');
    }
}