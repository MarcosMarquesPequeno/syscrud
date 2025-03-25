<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        /** @var Request $this */
        $userId = $this->route('user');

        $userId = $userId instanceof User ? $userId->id : $userId;
        return [
            'name' => 'required|string|max:255',
            'cpf' => [
                'required',
                'cpf',
                'max:14',
                Rule::unique('users')->ignore($userId) // Ignora o ID apenas se for uma atualização
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId) // Ignora o ID apenas se for uma atualização
            ],
            'password' => 'required|string|min:6|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.cpf' => 'O CPF informado não é válido.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'Campo senha é obrigatório',
            'password.min' => 'Campo senha deve ter no mínimo 6 caracteres',
        ];
    }
}
