<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::latest('id')->paginate(5);
        // dd($data);
        return view('admin.customer.index', compact('data')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
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

            Customer::query()->create($data);

            return redirect()->route('customers.index')->with('success', true);
        } catch (\Throwable $th) {
            return back()->with('success', true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('admin.customer.show', compact('customer'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name'  => 'required|max:255',
            'address'   => 'required|max:255',
            'phone'     => [
                'required', 'max:20',
                Rule::unique('customers')->ignore($customer->id)
            ],
            'email'     => 'required|max:100|email',
            'is_active'     => [
                'nullable',
                Rule::in([0,1]),
            ],
        ]);

        try {

            $data['is_active'] ??= 0;

            $customer->update($data);

            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {

            $customer->delete();

            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()->with('success', false);
        }
    }

    public function forceDestroy(Customer $customer)
    {
        try {

            $customer->forceDelete();

            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()->with('success', false);
        }
    }
}
