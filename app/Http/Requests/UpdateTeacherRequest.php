<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('teachers')->ignore($this->id),
            ],
            'phone' => 'required',
            'address' => 'nullable|max:255',
        ];
    }
}
