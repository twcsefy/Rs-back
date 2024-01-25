<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ADMRequest extends FormRequest
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
            'email'  => 'required|max:120|email|unique:clientes,email,' . $this->id,
            'cpf' => 'required|numeric|max:99999999999|min:10000000000|unique:clientes,cpf,' . $this->id,
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>$validator->errors()
        ]));
     }
     public function messages()
     {
         return  [
          
             'email.required' => 'O campo email é obrigatório.',
             'email.max' => 'O campo email não pode ter mais de 120 caracteres.',
             'email.email' => 'Por favor, insira um email válido.',
             'email.unique' => 'Este email já está em uso.',
             'cpf.required' => 'O campo CPF é obrigatório.',
             'cpf.numeric' => 'O campo CPF deve conter apenas números.',
             'cpf.max' => 'O campo CPF deve ter no maximo 11 dígitos.',
             'cpf.min' => 'O campo CPF deve ter no minimo 11 dígitos.',
             'cpf.unique' => 'Este CPF já está em uso.',
           
 
         ];
     }
}
