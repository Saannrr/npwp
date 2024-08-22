<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PphpasalUpdateRequest extends FormRequest
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
            'tahun_pajak' => ['nullable', 'max:4', 'min:4'],
            'masa_pajak' => ['nullable', 'in:januari,februari,maret,april,mei,juni,juli,agustus,september,oktober,november,desember'],
            'dokumen_pph_pasal_id' => ['nullable'],
            'kode_objek_pajak' => ['nullable'],
            'fasilitas_pajak_penghasilan' => ['nullable', 'in:tanpa fasilitas,surat keterangan bebas,pph ditanggung pemerintah,surat keterangan berdasarkan pp no 23 2018,fasilitas lainnya berdasarkan'],
            'no_fasilitas' =>  ['nullable', 'required_unless:fasilitas_pajak_pengbayaran,tanpa fasilitas'],
            'jumlah_penghasilan_bruto' => ['nullable', 'integer'],
            'tarif' => ['nullable', 'decimal:0,5'],
            'jumlah_setor' => ['nullable', 'integer'],
            'penandatangan_bukti_potong' => ['nullable', 'in:pengurus,kuasa'],
            'kelebihan_pemotongan' => ['nullable', 'in:pengembalian,pemindahbukuan'],
            'status' => ['nullable']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
        ], 400));
    }
}
