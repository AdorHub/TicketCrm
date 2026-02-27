<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:2|max:100',
			'email' => 'required|max:255|email|unique:users',
			'password' => 'required|min:8|max:72|confirmed'
        ];
    }

	public function messages(): array
	{
		return [
			'name.required' => "Обязательно для заполнения",
			'name.min' => 'Минимальная длина :min символа',
			'name.max' => 'Максимальная длина :max символов',

			'email.required' => "Обязательно для заполнения",
			'email.max' => 'Максимальная длина :max символов',
			'email.email' => 'Невалидный почтовый адрес',
			'email.unique' => 'Почта уже зарегистрирована',

			'password.required' => "Обязательно для заполнения",
			'password.min' => 'Минимальная длина :min символов',
			'password.max' => 'Максимальная длина :max символов',
			'password.confirmed' => 'Пароли не совпадают'
		];
	}
}
