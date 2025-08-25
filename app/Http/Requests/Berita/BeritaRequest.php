<?php

namespace App\Http\Requests\Berita;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
            'is_publish' => ['nullable', 'boolean'],
            'id_kategori_berita' => ['required', 'exists:kategori_beritas,id'],
        ];
    }

    /**
     * Custom messages for validation.
     */
    public function messages(): array
    {
        return [
            'id_kategori_berita.required' => 'Kategori berita harus diisi.',
            'id_kategori_berita.exists' => 'Kategori berita yang dipilih tidak tersedia.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            // Jika request API, return JSON
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422));
        }

        // Jika request dari form HTML (backend), biarkan default behavior redirect
        parent::failedValidation($validator);
    }
}
