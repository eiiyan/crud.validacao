<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoFormRequest extends FormRequest
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
            'nome'=>'required|min:3|max:80',
            'codigo'=>'required|unique:produtos,codigo',
            'preco'=>'required',
            'quantidade_estoque'=>'required'
            

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=>false,
                'message'=>'Erro de validação',
                'errors'=>$validator->errors()
            ], 422));
        
        }

        public function messages(){
            return[
                'nome.required'=>'O campo nome é obrigatório',
                'nome.min'=>'O campo nome requer no mínimo 3 caracteres',
                'nome.max'=>'O campo nome requer no máximo 80 caracteres',
                'codigo.required'=>'O campo código é obrigatório',
                'codigo.unique'=>'Este código já está cadastrado',
                'preco.required'=>'O campo preço é obrigatório',
                'quantidade_estoque.required'=>'O campo quantidade_estoque é obrigatório',


            ];
        }
}
