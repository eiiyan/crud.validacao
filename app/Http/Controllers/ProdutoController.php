<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use App\Http\Requests\ProdutoUpdateFormRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store(ProdutoFormRequest $request){
        $produto = Produto::create([
            'nome'=>$request->nome,
            'codigo'=>$request->codigo,
            'preco'=>$request->preco,
            'quantidade_estoque'=>$request->quantidade_estoque
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Produto cadastrado',
            'data'=>$produto
        ]);
    }

    public function index(){
        $produto = Produto::all();

        return response()->json([
            'status'=>true,
            'message'=>"Produto encontrado",
            'data'=>$produto
        ]);
     
    }

    public function show($id){
        $produto = Produto::find($id);

        if($produto == null){
            return response()->json([
                'status'=>false,
                'message'=> "Produto não encontrado"
            ]);
        }

        return response()->json([
            'status'=>true,
            'message'=>"Produto encontrado",
            'data'=>$produto
        ]);
    }

    public function update(ProdutoUpdateFormRequest $request){
        $produto = Produto::find($request->id);

        if($produto == null){
            return response()->json([
                'status'=>false,
                'message'=>"Produto não encontrado"
            ]);
        }

        if(isset($request->nome)){
            $produto->nome = $request->nome;
            
        }

        if(isset($request->codigo)){
            $produto->codigo = $request->codigo;
        }

        if(isset($request->preco)){
            $produto->preco = $request->preco;
        }

        if(isset($request->quantidade_estoque)){
            $produto->quantidade_estoque = $request->quantidade_estoque;
        }

        $produto->update();

        return response()->json([
            'status'=>true,
            'message'=>"Produto atualizado",
            'data'=>$produto
        ]);
    }

    public function delete($id)
    {
        $produto = Produto::find($id);

        if ($produto == null) {
            return response()->json([
                'status' => false,
                'message' => "Produto não encontrado"
            ]);
        }

        $produto->delete();

        return response()->json([

            'status' => true,
            'message' => "Produto deletado",
            'data'=>$produto
        ]);
    }


}