<?php

namespace App\Http\Requests\Slideshow;

use Illuminate\Foundation\Http\FormRequest;

class SlideshowRequest extends FormRequest
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
            'file' => 'required|array',
            'file.*' => 'required|mimes:jpg,jpeg,png',

            'headline' => 'required|array',
            'headline.*' => 'required|string|max:255',
        ];
    }
}
