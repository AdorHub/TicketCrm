<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FiltersRequest extends FormRequest
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
            'from_date' => 'nullable|date',
			'to_date' => 'nullable|date',
			'email' => 'nullable|string',
			'phone' => 'nullable|max:15|regex:/^\+?[0-9]+/',
			'status' => 'in:all,new,processing,processed'
        ];
    }

	public function messages(): array
	{
		return [
			'from_date.date' => 'Фильтр «Дата от» должно быть датой',
			'to_date.date' => 'Фильтр «Дата до» должно быть датой',
			'email.string' => 'Фильтр «E-mail» должно быть строкой',
			'phone.max' => 'Фильтр «Телефон» не должно превышать :max символов',
			'phone.regex' => 'Фильтр «Телефон» должно содержать только цифры',
			'status.in' => 'Выбран недопустимый статус. Допустимые значения: Все, Новые, В процессе, Обработанные',
		];
	}
}
