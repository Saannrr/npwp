<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RekamSptBpCreateRequest extends FormRequest
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
            'jenis_bukti_penyetoran' => ['required', 'in:surat setoran pajak,pemindahbukuan'],
            'npwp_id' => ['required', 'min:15', 'max:15'],
            'ntpn_id' => ['required_if:jenis_bukti_penyetoran,surat setoran pajak', 'min:16', 'max:16'],
            'nomor_pemindahbukuan' => ['required_if:jenis_bukti_penyetoran,pemindahbukuan'],
            'tahun_pajak' => ['required', 'min:4', 'max:4'],
            'beda_npwp_id' => ['nullable', 'boolean'],
        ];
    }
}
