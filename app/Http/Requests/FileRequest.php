<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:128'
        ];
    }

    public function messages(): array{
        return [
            'picture.required' => 'Please upload a picture',
            'picture.image' => 'Please upload a picture',
            'picture.max' => 'Maksimal ukuran gambar 128kb'
        ];
    }
}
