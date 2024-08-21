<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DokumenPphpasalCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    //  TODO: coba pikirin biar pphpasal_id ga boleh kosong dan otomatis diisi dengan id pphpasal yang sedang di isi
    public function rules()
    {
        return [
            'nama_dokumen' => ['required', 'max:100'],
            'no_dokumen' => ['required', 'max:100'],
            'tgl_dokumen' => ['required'],
            'pphpasal_id' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
        ], 400));
    }
}
