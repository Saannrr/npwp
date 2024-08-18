<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PphpasalCreateRequest extends FormRequest
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
            'pengaturan_id' => ['required'],
            'tahun_pajak' => ['required', 'max:4', 'min:4'],
            'masa_pajak' => ['required'],
            'nama' => ['required', 'string', 'max:255'],
            'identitas' => ['required', 'in:npwp,nik'],
            'npwp_id' => ['required_if:identitas,npwp', 'max:15', 'min:15'],
            'nik_id' => ['required_if:identitas,nik', 'max:16', 'min:16'],
            'dasar_pemotongan_id' => ['required'],
            'kode_objek_pajak' => ['required'],
            'fasilitas_pajak_penghasilan' => ['required', 'in:tanpa fasilitas,surat keterangan bebas,pph ditanggung pemerintah,surat keterangan berdasarkan pp no 23 2018,fasilitas lainnya berdasarkan'],
            'no_fasilitas' => ['required_unless:fasilitas_pajak_penghasilan,tanpa fasilitas'],
            'jumlah_penghasilan_bruto' => ['required'],
            'tarif' => ['required'],
            'jumlah_setor' => ['required'],
            'kelebihan_pemotongan' => ['required', 'in:pengembalian,pemindahbukuan'],
            'status' => ['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
        ], 400));
    }
}
