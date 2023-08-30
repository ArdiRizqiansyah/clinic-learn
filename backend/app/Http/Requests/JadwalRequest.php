<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // get role user
        $role = auth()->user()->getRoleNames()[0];

        return true && $role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // check if request method is POST
        if($this->method() == 'POST'){
            return [
                'dokter_id' => 'required|exists:dokter,id',
                'kouta' => 'required|numeric',
            ];
        }

        return [
            'kouta' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'dokter_id.required' => 'Dokter harus dipilih',
            'dokter_id.exists' => 'Dokter tidak ditemukan',
            'kouta.required' => 'Kouta harus diisi',
            'kouta.numeric' => 'Kouta harus berupa angka',
        ];
    }
}
