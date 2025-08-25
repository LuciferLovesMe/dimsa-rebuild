<?php

namespace App\Http\Requests\Slideshow;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlideShowRequest extends FormRequest
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
            'id' => 'required|array',
            'id.*' => 'required|exists:slideshows,id',
            'headline' => 'nullable|array',
            'headline.*' => 'nullable|string',
            'file' => 'nullable|array',
            'file.*' => 'nullable|file|image|max:2048',
        ];
    }
}
