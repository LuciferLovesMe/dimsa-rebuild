<?php

namespace App\Http\Requests\ProgramUnggulan;

use Illuminate\Foundation\Http\FormRequest;

class ProgramUnggulanRequest extends FormRequest
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
        // Menentukan aturan validasi dasar
        $rules = [
            'nama_program' => ['required', 'string', 'max:255'],
            'deskripsi'    => ['required', 'string'],
            'url'          => ['nullable', 'url'],
            'is_publish'   => ['required', 'boolean'],
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
        } else {
            $rules['image'] = ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'];
        }

        return $rules;
    }
}
