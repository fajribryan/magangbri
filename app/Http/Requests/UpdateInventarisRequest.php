<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarisRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tid' => 'required',
            'merek_mesin' => 'required',
            'tipe_mesin' => 'required',
            'jenis_mesin' => 'required',
            'merek_cctv' => 'required',
            'merek_ups' => 'required',
            'vendor_slm_cctv' => 'required',
            'vendor_slm_ups' => 'required',
            'vendor_kebersihan' => 'required',
            'vendor_pjpur' => 'required',
            'cover' => 'required',
            'lokasi' => 'required',
            'long' => 'required',
            'lat' => 'required',
            'jenis_lokasi' => 'required',
            'tipe_lokasi' => 'required',
            'kategori_lokasi' => 'required',
            'kategori_grup' => 'required',
            'nilai_sewa_tahunan' => 'required',
            'sewa_mulai' => 'required',
            'sewa_akhir' => 'required',
            'kode_kc' => 'required',
            'nama_kc' => 'required',
            'kode_uko' => 'required',
            'nama_uko' => 'required',
            'kode_ro' => 'required',
            'nama_ro' => 'required',
        ];
    }
}
