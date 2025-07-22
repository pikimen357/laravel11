<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
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
            'title' => ['required'],
            'description' => 'required|min:3',
            'release_date' => ['required', Rule::date()->beforeToday()],
            'cast' => 'required',
            'genres' => 'required',
            'image' => 'required',
        ];
    }

    public function messages(): array{
        return [
            'title.required' => 'Berikan judul',
            'description.required' => 'Berikan deskripsi',
            'description.min' => 'deskripsi minimal 3 karakter',
            'release_date.required' => 'Masukkan tanggal rilis',
            'release_date.before' => 'Tanggal rilis harus sebelum hari ini',
            'cast.required' => 'Berikan beberapa cast',
            'genres.required' => 'Berikan link gambar',
        ];
    }
}
