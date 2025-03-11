<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'unit'])->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('products.create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $code = $this->generateUniqueCode();
        $price = str_replace('.', '', $request->price);

        Product::create([
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'code' => $code,
            'name' => $request->name,
            'price' => $price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('products.edit', compact('product', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $price = str_replace('.', '', $request->price);
        $product->update([
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'price' => $price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->transactionDetails()->exists()) {
            return redirect()->route('products.index')->with('error', 'Produk tidak dapat dihapus karena masih digunakan dalam transaksi.');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function generateUniqueCode()
    {
        do {
            $code = 'PRD-' . strtoupper(Str::random(8));
        } while (Product::where('code', $code)->exists());

        return $code;
    }
}
