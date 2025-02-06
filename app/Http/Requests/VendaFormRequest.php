<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaFormRequest extends FormRequest
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
            'cliente_id'=>'required|max:255',
            'data_venda'=>'max:255',
            'subtotal'=>'max:255',
            'desconto'=> 'max:255',
            'total'=>'max:255'
            
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
            return [
                'cliente_id.required'=>'O campo cliente_id é obrigatório',
                'cliente_id.max'=>'O campo cliente_id requer no máximo 255 caracteres',
                'data_venda.max'=>'O campo data_venda requer no máximo 255 caracteres',
                'subtotal.max'=>' O campo subtotal requer no máximo 255 carcteres',
                'desconto.max'=>'O campo desconto requer no máximo 255 caracteres',
                'total.max'=> 'O campo total requer no máximo 255 caracteres'


            ];
        }
}
