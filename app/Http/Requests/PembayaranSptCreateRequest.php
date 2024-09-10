<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranSptCreateRequest extends FormRequest
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
            'kode_billing' => ['required', 'string', 'max:255'],
            'jumlah_setor' => ['required', 'numeric'],
            'nama_bank' => ['required', 'string', 'max:255'],
            'npwp_penyetor' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
        ];
    }
}
