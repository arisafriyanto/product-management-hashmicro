<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::latest()->get();
        return view('discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        $data = $request->validated();
        $data['code'] = strtoupper($data['code']);
        $data['value'] = str_replace('.', '', $data['value']);

        if (isset($data['min_purchase'])) {
            $data['min_purchase'] = str_replace('.', '', $data['min_purchase']);
        }


        Discount::create($data);
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil ditambahkan.');
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
    public function edit(Discount $discount)
    {
        return view('discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, Discount $discount)
    {
        $data = $request->validated();
        $data['code'] = strtoupper($data['code']);
        $data['value'] = str_replace('.', '', $data['value']);

        if (isset($data['min_purchase'])) {
            $data['min_purchase'] = str_replace('.', '', $data['min_purchase']);
        }

        $discount->update($data);
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Diskon berhasil dihapus.');
    }
}
