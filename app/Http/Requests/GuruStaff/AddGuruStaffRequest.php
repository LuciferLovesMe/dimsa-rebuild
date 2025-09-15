<?php

namespace App\Http\Requests\GuruStaff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddGuruStaffRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'is_publish' => ['nullable', 'boolean'],

            'riwayat_pendidikan' => ['nullable', 'array'],
            'riwayat_pendidikan.*.tingkat_pendidikan' => [
                'required',
                'string',
                Rule::in(['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])
            ],
            'riwayat_pendidikan.*.instansi' => ['nullable', 'string', 'max:255'],
            'riwayat_pendidikan.*.tahun_mulai' => ['required', 'integer', 'digits:4'],
            'riwayat_pendidikan.*.tahun_akhir' => ['nullable', 'integer', 'digits:4'],

            'pengalaman_kerja' => ['nullable', 'array'],
            'pengalaman_kerja.*.posisi' => ['required', 'string', 'max:255'],
            'pengalaman_kerja.*.perusahaan' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja.*.kota' => ['required', 'string', 'max:100'],
            'pengalaman_kerja.*.tahun_mulai' => ['required', 'integer', 'digits:4'],
            'pengalaman_kerja.*.tahun_akhir' => ['nullable', 'integer', 'digits:4'],

            'prestasis' => ['nullable', 'array'],
            'prestasis.*.nama_lomba' => ['required', 'string', 'max:255'],
            'prestasis.*.penyelenggara' => ['nullable', 'string', 'max:255'],
            'prestasis.*.tingkat' => [
                'required',
                'string',
                Rule::in(['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'])
            ],
            'prestasis.*.predikat' => [
                'required',
                'string',
                Rule::in(['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'Harapan 3', 'Finalis', 'Peserta'])
            ],
            'prestasis.*.tahun' => ['required', 'integer', 'digits:4'],

        ];
    }
}
