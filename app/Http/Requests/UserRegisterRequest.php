<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'max:100'],
            'role' => ['required', 'in:company,individual'],
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'required_if:role,individual', 'string', 'max:100'],
            'jabatan' => ['nullable', 'required_if:role,individual', 'string', 'max:255'],
            'kategori_perusahaan' => ['nullable', 'required_if:role,company', 'string', 'max:255'],
            'npwp' => ['required', 'string', 'max:15', 'min:15'],
            'nik' => ['nullable', 'required_if:role,individual', 'string', 'max:16', 'min:16'],
            'alamat' => ['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
        ], 400));
    }
}
