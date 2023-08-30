<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalDetailRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // check if request method is POST
        if($this->method() == 'POST'){
            return [
                'jadwal_id' => 'required|exists:jadwal,id',
                'hari' => 'required|numeric|between:1,7',           
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
            ];
        }

        return [
            'hari' => 'required|numeric|between:1,7',           
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ];
    }
}
