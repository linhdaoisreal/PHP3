<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::paginate(5);

        // dd($data);

        return view('admin.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('products')],
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'is_active' => ['required', Rule::in(0, 1)],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        try {
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products', $request->file('image'));
            }

            Product::query()->create($data);

            return redirect()
                ->route('products.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            return back()
                ->with('success', value: false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('products')->ignore($product->name)],
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'is_active' => ['nullable', Rule::in(0, 1)],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        try {
            $data['is_active'] ??= 0; 

            if ($request->hasFile('image')) {
                $data['image'] = Storage::put('products', $request->file('image'));
            }

            $currentImg = $product->image;

            $product->update($data);

            if ($request->hasFile('image') && !empty($currentImg) && Storage::exists($currentImg)) {
                Storage::delete($currentImg);
            }

            return back()
                ->with('success', true);
        } catch (\Throwable $th) {
            if (!empty($data['image']) && Storage::exists($data['image'])) {
                Storage::delete($data['image']);
            }

            return redirect()
                ->route('products.index')
                ->with('success', value: false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return back()
                ->with('success', true);
        } catch (\Throwable $th) {
            return redirect()
                ->route('products.index')
                ->with('success', value: false)
                ->with('error', $th->getMessage());
        }
    }

    public function forceDestroy(Product $product)
    {
        try {
            $product->forceDelete();

            if (!empty($product->image) && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            return back()
                ->with('success', true);
        } catch (\Throwable $th) {
            return redirect()
                ->route('products.index')
                ->with('success', value: false)
                ->with('error', $th->getMessage());
        }
    }
}
