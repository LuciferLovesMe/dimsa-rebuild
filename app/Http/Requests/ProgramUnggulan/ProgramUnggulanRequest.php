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
        return [
            'nama_program' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'url' => ['required', 'url'],
            'is_publish' => ['nullable', 'boolean'],
        ];
    }
}
