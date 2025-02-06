<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class ItemVendaFormRequest extends FormRequest
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
            'venda_id'=>'required|max:255',
            'produto_id'=>'required|max:255',
            'quantidade'=>'required|max:255',
            'preco_unitario'=> 'required|max:255',
            'subtotal_item'=>'max:255'
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
                'venda_id.required'=>'O campo venda_id é obrigatório',
                'venda_id.max'=>'O campo venda_id requer no máximo 255 caracteres',
                'produto_id.required'=>'O campo produto_id é obrigatório',
                'produto_id.max'=>'O campo produto_id requer no máximo 255 caracteres',
                'quantidade.required'=>'O campo quantidade é obrigatório',
                'quantidade.max'=>'O campo quantidade requer no máximo 255 caracteres',
                'preco_unitario.required'=>'O campo preco_unitario é obrigatório',
                'preco_unitario.max'=>' O campo preco_unitario requer no máximo 255 caracteres',
                'subtotal_item.max'=>'O campo subtotal_item requer no máximo 255 caracteres',
            
            ];
        }
}
