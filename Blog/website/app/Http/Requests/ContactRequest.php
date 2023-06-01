<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|min:10|max:100',
            'subject' => 'required|min:5|max:150',
            'message' => 'required|min:5|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя является обязательным.',
            'name.min' => 'Имя не может состоять менее, чем из 2 букв.',
            'name.max' => 'Превышен лимит букв имени в 100 символов.',
            'email.required' => 'Email является обязательным.',
            'email.email' => 'Email введен не корректно.',
            'email.min' => 'Email не может состоять менее, чем из 10 букв.',
            'email.max' => 'Превышен лимит букв email в 100 символов.',
            'subject.required' => 'Тема является обязательной.',
            'subject.min' => 'Тема не может состоять менее, чем из 5 букв.',
            'subject.max0' => 'Превышен лимит букв темы в 150 символов.',
            'message.required' => 'Сообщение является обязательным.',
            'message.min' => 'Сообщение не может состоять менее, чем из 5 букв.',
            'message.max' => 'Превышен лимит букв сообщение в 1000 символов.',
        ];
    }
}
