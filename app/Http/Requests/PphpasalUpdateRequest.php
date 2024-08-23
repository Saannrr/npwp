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
            'tahun_pajak' => ['sometimes', 'max:4', 'min:4'],
            'masa_pajak' => ['sometimes', 'in:januari,februari,maret,april,mei,juni,juli,agustus,september,oktober,november,desember'],
            'nama' => ['sometimes', 'string', 'max:255'],
            'identitas' => ['sometimes', 'in:npwp,nik'],
            'npwp_id' => ['sometimes', 'required_if:identitas,npwp', 'max:15', 'min:15'],
            'nik_id' => ['sometimes', 'required_if:identitas,nik', 'max:16', 'min:16'],
            'dokumen_pph_pasal_id' => ['sometimes', 'exists:dokumen_pph_pasals,id'],
            'kode_objek_pajak' => ['sometimes'],
            'fasilitas_pajak_penghasilan' => ['sometimes', 'in:tanpa fasilitas,surat keterangan bebas,pph ditanggung pemerintah,surat keterangan berdasarkan pp no 23 2018,fasilitas lainnya berdasarkan'],
            'no_fasilitas' =>  ['sometimes', 'required_unless:fasilitas_pajak_pengbayaran,tanpa fasilitas'],
            'jumlah_penghasilan_bruto' => ['sometimes', 'integer'],
            'tarif' => ['sometimes', 'decimal:0,5'],
            'jumlah_setor' => ['sometimes', 'integer'],
            'pengaturan_id' => ['sometimes'],
            'penandatangan_bukti_potong' => ['sometimes', 'in:pengurus,kuasa'],
            'kelebihan_pemotongan' => ['sometimes', 'in:pengembalian,pemindahbukuan'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag(),
        ], 400));
    }
}
