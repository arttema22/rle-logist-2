<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use MoonShine\Laravel\Http\Requests\MoonShineFormRequest;

class ProfitCreateRequest extends MoonShineFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('moonshine')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
        ];
    }
}
