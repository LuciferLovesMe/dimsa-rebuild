<?php

namespace App\Http\Requests\KaryaIlmiah;

use Illuminate\Foundation\Http\FormRequest;

class KaryaIlmiahRequest extends FormRequest
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
            "judul" => ['required', 'string', 'max:255'],
            "penulis" => ['required', 'string', 'max:255'],
            "tanggal_terbit" => ['nullable', 'date'],
            "url" => ['required', 'url'],
            "image" => ['required', 'image', 'mimes:png,jpg,jpeg',],
            "is_publish" => ['nullable', 'boolean']


        ];
    }
}
