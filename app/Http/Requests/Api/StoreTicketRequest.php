<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreTicketRequest extends FormRequest
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
	public function rules()
	{
		return [
			'name' => 'required|string|min:3|max:64',
			'email' => 'required|email',
			'phone' => 'required|string|max:15|regex:/^\+?[0-9]+/',
			'subject' => 'required|string|min:3|max:255',
			'text' => 'required|string',
			'attachments' => 'max:5',
			'attachments.*' => 'file|max:102400|mimetypes:image/jpeg,image/jpg,image/png,image/gif,image/webp,audio/mpeg,audio/wav,audio/ogg,audio/mp3,video/mp4,video/quicktime,video/x-msvideo,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain'
		];
	}


	public function messages(): array
	{
		return [
			'name.required' => 'Поле обязательно для заполнения',
			'name.string' => 'Поле должно быть текстом',
			'name:min' => 'Минимальное значение :min символа',
			'name.max' => 'Максимальное значение :max символов',

			'email.required' => 'Поле обязательно для заполнения',
			'email.email' => 'Невалидный адрес',

			'phone.required' => 'Поле обязательно для заполнения',
			'phone.string' => 'Поле должно быть текстом',
			'phone.max' => 'Максимальное значение :max символов',
			'phone.regex' => 'Невалидный номер телефона',

			'subject.required' => 'Поле обязательно для заполнения',
			'subject.string' => 'Поле должно быть текстом',
			'subject.min' => 'Минимальное значение :min символа',
			'subject.max' => 'Максимальное значение :max символов',

			'text.required' => 'Поле обязательно для заполнения',
			'text.string' => 'Поле должно быть текстом',

			'attachments.max' => 'Нельзя загружать больше :max файлов за раз',
			'attachments.*.file' => 'Каждый выбранный файл должен быть действительным файлом',
			'attachments.*.max' => 'Максимально допустимый размер файлов :max',
			'attachments.*.mimetypes' => 'Недопустимый тип файла. Допустимые: изображения, аудио, видео, документы.'
		];
	}

	public function failedValidation(Validator $validator)
	{
		if (request()->expectsJson()) {
			throw new ValidationException($validator);
		}
	}
}
