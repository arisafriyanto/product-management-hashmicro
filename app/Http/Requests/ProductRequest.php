<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $productId = $this->product ? $this->product->id : null;

        return [
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:100|unique:products,name,' . $productId,
            'price' => 'required|min:0',
            'stock' => 'required|integer|min:0',
        ];
    }


    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib diisi.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'unit_id.required' => 'Satuan wajib diisi.',
            'unit_id.exists' => 'Satuan yang dipilih tidak valid.',

            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk tidak boleh lebih dari 100 karakter.',
            'name.unique' => 'Nama produk sudah digunakan.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.min' => 'Harga produk tidak boleh kurang dari 0.',

            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok produk harus berupa bilangan bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',
        ];
    }
}
