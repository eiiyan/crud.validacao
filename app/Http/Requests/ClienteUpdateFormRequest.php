<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteUpdateFormRequest extends FormRequest
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
            'nome'=>'min:3|max:80',
            'email'=>'unique:clientes,email|min:6|max:80',
            'telefone'=>'min:6|max:80',
            'endereco'=>'min:6|max:80'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(
         response()->json([
            'status'=>false,
            'message'=>'Erro de Validação',
            'errors'=>$validator->errors()
         ], 422));
       
        
        }

        public function messages(){
            return[
                'nome.min'=>'O campo nome requer no mínimo 3 caracteres',
                'nome.max'=>'O campo nome requer no máximo 80 caracteres',
                'email.unique'=>'Este email já está cadastrado',
                'email.min'=>'O campo email requer no mínimo 6 caracteres',
                'email.max'=>'O campo email requer no máximo 80 caracteres',
                'telefone.min'=>'O campo telefone requer no mínimo 6 caracteres',
                'telefone.max'=>'O campo telefone requer no máximo 80 caracteres',
                'endereco.min'=>'O campo endereco requer no mínimo 6 caracteres',
                'endereco.max'=>'O campo endereco requer no máximo 80 caracteres',

                

            ];
        }
}
