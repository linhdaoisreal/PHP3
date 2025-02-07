<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        return response()->json([
            'status'    => true,
            'message'   => 'Lấy dữ liệu thành công',
            'data'  => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $data = $request->all();

        $data = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('products')],
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'is_active' => ['required', Rule::in(0, 1)],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        try {

            $product = Product::query()->create($data);

            return response()->json([
                'status'    => true,
                'message'   => 'Thêm liệu thành công',
                'data'  => $product
            ], 201);
        } catch (\Throwable $th) {
            Log::error(
                __CLASS__.'@'.__FUNCTION__,
                [
                    'message' => $th->getMessage(),
                ]
            );

            return response()->json([
                'status'    => false,
                'message'   => 'Thêm liệu thành công',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::find($id);

        if ($data) {
            return response()->json([
                'status'    => true,
                'message'   => 'Lấy dữ liệu thành công',
                'data'  => $data
            ]);
        }

        return response()->json([
            'status'    => false,
            'message'   => 'Lấy dữ liệu không thành công',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $data = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('products')],
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'is_active' => ['required', Rule::in(0, 1)],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status'    => false,
                'message'   => 'Lấy dữ liệu khôgn thành công',
            ]);
        }

        try {

            $product->update($data);

            return response()->json([
                'status'    => true,
                'message'   => 'Cập nhật liệu thành công',
                'data'  => $product
            ], 201);
        } catch (\Throwable $th) {
            Log::error(
                __CLASS__.'@'.__FUNCTION__,
                [
                    'message' => $th->getMessage(),
                ]
            );

            return response()->json([
                'status'    => false,
                'message'   => 'Lỗi hệ thống',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Product::destroy($id);

            return response()->json([
                'status'    => true,
                'message'   => 'Xóa liệu thành công'
            ]);
        } catch (\Throwable $th) {
            Log::error(
                __CLASS__.'@'.__FUNCTION__,
                [
                    'message' => $th->getMessage(),
                ]
            );

            return response()->json([
                'status'    => false,
                'message'   => 'Lỗi hệ thống',
            ], 500);
        }
    }
}
