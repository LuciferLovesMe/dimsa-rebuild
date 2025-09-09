<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'image' => 'required|array|min:1',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_publish' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Anda harus mengupload setidaknya satu foto fasilitas.',
            'image.min' => 'Anda harus mengupload setidaknya satu foto fasilitas.',
            'image.*.image' => 'File yang diupload harus berupa gambar.',
            'image.*.mimes' => 'Format gambar harus jpeg, png, jpg, gif, svg, atau webp.',
        ];
    }
}
