<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaFormRequest;
use App\Http\Requests\VendaUpdateFormRequest;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{

    public function store(VendaFormRequest $request)
    {
        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda' => date('Y:m-d H:i:s'),
            'subtotal' => 0, // declarando que o subtotal e total é 0 
            'desconto' => $request->desconto,
            'total' => 0
        ]);

        $subtotal = 0; //tudo que está procurando dentro do foreach está pesquisando dentro do array
        foreach ($request->itens as $item) {
            $subtotal += $item['quantidade'] * $item['preco'];
            $produto = Produto::find($item['produto_id']);

            $itemVenda = ItemVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $produto->id,
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $produto->preco,
                'subtotal_item' => $item['quantidade'] * $item['preco']

            ]);

            $produto = Produto::find($itemVenda->produto_id);
            $produto->quantidade_estoque -= $item['quantidade'];
            $produto->update();
            //Até aqui atualizou o estoque dos produtos que antes não tinha declarado o valor
        }

        // Agora vamos atualizar o total e subtotal da venda 
        $venda->update([
            'subtotal' => $subtotal,
            'total' => $subtotal - $request->desconto

        ]);



        return response()->json([
            'status' => true,
            'message' => 'Dados cadastrados',
            'data' => $venda
        ]);
    }

    public function index()
    {
        $venda = Venda::all();

        return response()->json([
            'status' => true,
            'message' => 'Venda encontrada',
            'data' => $venda
        ]);
    }

    public function show($id)
    {
        $venda = Venda::find($id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => "Venda não encontrada"
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Venda encontrada",
            'data' => $venda
        ]);
    }

    public function update(VendaUpdateFormRequest $request)
    {
        $venda = Venda::find($request->id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => "Venda não encontrada"
            ]);
        }

        if (isset($request->cliente_id)) {
            $venda->cliente_id = $request->cliente_id;
        }

        if (isset($request->data_venda)) {
            $venda->data_venda = $request->data_venda;
        }

        if (isset($request->subtotal)) {
            $venda->subtotal = $request->subtotal;
        }

        if (isset($request->desconto)) {
            $venda->desconto = $request->desconto;
        }

        if (isset($request->total)) {
            $venda->total = $request->total;
        }

        $venda->update();

        return response()->json([
            'status' => true,
            'message' => "Venda atualizada",
            'data' => $venda
        ]);
    }

    public function delete($id)
    {
        $venda = Venda::find($id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => "Venda não encontrada"
            ]);
        }

        $venda->delete();

        return response()->json([

            'status' => true,
            'message' => "Venda deletada",
            'data' => $venda
        ]);
    }
}
