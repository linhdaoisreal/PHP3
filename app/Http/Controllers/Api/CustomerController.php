<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::latest('id')->paginate(5);

        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu thành công',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $data = request()->validate([
            'name'  => 'required|max:255',
            'address'   => 'required|max:255',
            'phone'     => [
                'required', 'max:20',
                Rule::unique('customers')
            ],
            'email'     => 'required|max:100|email',
            'is_active'     => [
                'nullable',
                Rule::in([0,1]),
            ],
        ]);

        try {

            $customer = Customer::query()->create($data);

            return response()->json([
                'status' => true,
                'message' => 'Thêm dữ liệu thành công',
                'data' => $customer,
            ], 201);

        } catch (\Throwable $th) {
            Log::error(
                __CLASS__.'@'.__FUNCTION__,
                [
                    'message' => $th->getMessage(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' => 'Lỗi hệ thống',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $data = Customer::find($id);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Lấy dữ liệu thành công',
                'data' => $data,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Lấy dữ liệu thất bại với: '.$id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        
        $data = request()->validate([
            'name'  => 'required|max:255',
            'address'   => 'required|max:255',
            'phone'     => [
                'required', 'max:20',
                Rule::unique('customers')->ignore($id)
            ],
            'email'     => 'required|max:100|email',
            'is_active'     => [
                'nullable',
                Rule::in([0,1]),
            ],
        ]);

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => false,
                'message' => 'Lấy dữ liệu thất bại với: '.$id
            ]);
        }

        try {

            $customer->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Thêm dữ liệu thành công',
                'data' => $customer,
            ], 201);

        } catch (\Throwable $th) {
            Log::error(
                __CLASS__.'@'.__FUNCTION__,
                [
                    'message' => $th->getMessage(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' => 'Lỗi hệ thống',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            Customer::destroy($id);

            return response()->json([
                'status' => true,
                'message' => 'Xóa dữ liệu thành công',
            ]);

        } catch (\Throwable $th) {

            Log::error(
                __CLASS__.'@'.__FUNCTION__,
                [
                    'message' => $th->getMessage(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' => 'Lỗi hệ thống',
            ], 500);

        }
        
    }
}
