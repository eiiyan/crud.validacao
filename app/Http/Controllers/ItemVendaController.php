<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemVendaUpdateFormRequest;
use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{

    public function index()
    {
        $itemVenda = ItemVenda::all();

        return response()->json([
            'status' => true,
            'message' => 'Item da Venda não encontrado',
            'data' => $itemVenda
        ]);
    }

    public function show($id)
    {
        $itemVenda = ItemVenda::find($id);

        if ($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => "Item da Venda não encontrado"
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => "Item da Venda encontrado",
            'data' => $itemVenda
        ]);
    }

    public function update(ItemVendaUpdateFormRequest $request)
    {
        $itemVenda = ItemVenda::find($request->id);

        if ($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => "Item da Venda não encontrado"
            ]);
        }

        if (isset($request->venda_id)) {
            $itemVenda->venda_id = $request->venda_id;
        }

        if (isset($request->produto_id)) {
            $itemVenda->produto_id = $request->produto_id;
        }

        if (isset($request->quantidade)) {
            $itemVenda->quantidade = $request->quantidade;
        }

        if (isset($request->preco_unitario)) {
            $itemVenda->preco_unitario = $request->preco_unitario;
        }

        if (isset($request->subtotal_item)) {
            $itemVenda->subtotal_item = $request->subtotal_item;
        }

        $itemVenda->update();

        return response()->json([
            'status' => true,
            'message' => "Item da Venda atualizado",
            'data' => $itemVenda
        ]);
    }

    public function delete($id)
    {
        $itemVenda = ItemVenda::find($id);

        if ($itemVenda == null) {
            return response()->json([
                'status' => false,
                'message' => "Item da Venda não encontrado"
            ]);
        }

        $itemVenda->delete();

        return response()->json([

            'status' => true,
            'message' => "Item da Venda deletado",
            'data' => $itemVenda
        ]);
    }

}
