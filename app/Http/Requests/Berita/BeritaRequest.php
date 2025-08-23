<?php

namespace App\Http\Requests\Berita;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
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
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp',],
            'is_publish' => ['nullable', 'boolean'],
            'id_kategori_berita' => ['required', 'exists:kategori_beritas,id'],
        ];
    }
}