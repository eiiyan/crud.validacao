<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteUpdateFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function store(ClienteFormRequest $request){
        $cliente = Cliente::create([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'telefone'=>$request->telefone,
            'endereco'=>$request->endereco
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'Cliente cadastrado',
            'data'=>$cliente
        ]);
    }

    public function index(){
        $cliente = Cliente::all();

        return response()->json([
            'status'=>true,
            'message'=>"Cliente encontrado",
            'data'=>$cliente
        ]);
     
    }

    public function show($id){
        $cliente = Cliente::find($id);

        if($cliente == null){
            return response()->json([
                'status'=>false,
                'message'=> "Cliente não encontrado"
            ]);
        }

        return response()->json([
            'status'=>true,
            'message'=>"Cliente encontrado",
            'data'=>$cliente
        ]);
    }

    public function update(ClienteUpdateFormRequest $request){
        $cliente = Cliente::find($request->id);

        if($cliente == null){
            return response()->json([
                'status'=>false,
                'message'=>"Cliente não encontrado"
            ]);
        }

        if(isset($request->nome)){
            $cliente->nome = $request->nome;
            
        }

        if(isset($request->email)){
            $cliente->email = $request->email;
        }

        if(isset($request->telefone)){
            $cliente->telefone = $request->telefone;
        }

        if(isset($request->endereco)){
            $cliente->endereco = $request->endereco;
        }

        $cliente->update();

        return response()->json([
            'status'=>true,
            'message'=>"Cliente atualizado",
            'data'=>$cliente
        ]);
    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente == null) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não encontrado"
            ]);
        }

        $cliente->delete();

        return response()->json([

            'status' => true,
            'message' => "Cliente deletado",
            'data'=>$cliente
        ]);
    }
}
