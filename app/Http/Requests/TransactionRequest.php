<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'discount_amount' => 'nullable',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Nama pembeli harus diisi.',
            'products.required' => 'Harap pilih produk.',
            'products.*.product_id.required' => 'Produk tidak valid.',
            'products.*.quantity.required' => 'Jumlah produk harus diisi.',
            'products.*.quantity.min' => 'Minimal 1 item.',
            'products.*.price.required' => 'Harga produk harus diisi.',
        ];
    }
}
