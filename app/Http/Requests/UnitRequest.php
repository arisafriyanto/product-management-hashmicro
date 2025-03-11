<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
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
        $unitId = $this->unit ? $this->unit->id : null;

        return [
            'name' => 'required|string|max:20|unique:units,name,' . $unitId,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama satuan wajib diisi.',
            'name.unique' => 'Nama satuan sudah ada.',
            'name.max' => 'Nama satuan maksimal 20 karakter.',
        ];
    }
}
