<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class PengaturanCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'bertindak_sebagai' => ['required', 'in:pengurus,kuasa'],
            'identitas' => ['required', 'in:npwp,nik'],
            'npwp_id' => ['required_if:identitas,npwp', 'max:15', 'min:15'],
            'nik_id' => ['required_if:identitas,nik', 'max:16', 'min:16'],
            'nama_penandatangan' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
        ], 400));
    }
}
