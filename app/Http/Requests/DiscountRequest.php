<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
        $discountId = $this->discount ? $this->discount->id : null;

        return [
            'code' => 'required|string|max:50|alpha_num|unique:discounts,code,' . $discountId,
            'name' => 'required|string|max:100',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|min:0',
            'min_purchase' => 'nullable|min:0',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Kode diskon harus diisi.',
            'code.unique' => 'Kode diskon sudah digunakan.',
            'code.alpha_num' => 'Kode diskon hanya boleh berisi huruf dan angka.',
            'name.required' => 'Nama diskon harus diisi.',
            'type.required' => 'Jenis diskon harus diisi.',
            'type.in' => 'Jenis diskon harus "percentage" atau "fixed".',
            'value.required' => 'Nilai diskon harus diisi.',
            'valid_until.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai.',
        ];
    }
}
