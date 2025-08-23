<?php

namespace App\Http\Requests\GuruStaff;

use Illuminate\Foundation\Http\FormRequest;

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
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'is_publish' => ['required', 'boolean'],

            'riwayat_pendidikan' => ['nullable', 'array'],
            'riwayat_pendidikan.*.tingkat_pendidikan' => ['required', 'string'],
            'riwayat_pendidikan.*.instansi' => ['nullable', 'string', 'max:255'],
            'riwayat_pendidikan.*.tahun_mulai' => ['required', 'integer'],
            'riwayat_pendidikan.*.tahun_akhir' => ['nullable', 'integer'],

            'pengalaman_kerja' => ['nullable', 'array'],
            'pengalaman_kerja.*.posisi' => ['required', 'string'],
            'pengalaman_kerja.*.perusahaan' => ['nullable', 'string', 'max:255'],
            'pengalaman_kerja.*.tahun_mulai' => ['required', 'integer'],
            'pengalaman_kerja.*.tahun_akhir' => ['nullable', 'integer'],

            'prestasis' => ['nullable', 'array'],
            'prestasis.*.nama_lomba' => ['required', 'string'],
            'prestasis.*.penyelenggara' => ['nullable', 'string', 'max:255'],
            'prestasis.*.tingkat' => ['required', 'string'],
            'prestasis.*.predikat' => ['required', 'string'],
            'prestasis.*.tahun' => ['required', 'integer'],

        ];
    }
}
