<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegistrerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string'],
            'email'=>['required','email','unique:users,email'],
            'password'=>[
                'required',
                'confirmed',
                Password::min(8)->letters()->symbols()->numbers(),
            ]
        ];
    }
    public function messages(){
        return [
            'name.required'=>'El nombre es obligatorio',
            'name.string'=>'El nombre no es válido',
            'email.required'=>'El email es obligatorio',
            'email.email'=>'El email no es válido',
            'email.unique'=>'El email ya ha sido tomado',
            'password.required'=>'La contraseña es obligatorio',
            'password.confirmed'=>'La contraseña debe ser cofirmada',
            'password'=>'La contraseña debe contener al menos 8 caracteres, un simbolo y un número',
        ];
    }
}
