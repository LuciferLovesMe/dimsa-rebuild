<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class AddPartnerRequest extends FormRequest
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
            'nama_mitra' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg', 'max:2048'],
            'is_publish' => ['nullable', 'boolean'],
        ];
    }
}
