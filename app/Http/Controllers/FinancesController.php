<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function index()
    {
        $financas = Finance::all();
        return view('financas.finance', compact('financas'));
    }

    public function show()
    {
        $financas = Finance::query()->get();
        ;
        $total_entrada = 0;
        $total_saida = 0;

//
        foreach ($financas as $item) {
            if ($item->tipo == "entrada") {
                $total_entrada += $item->valor;
                $item->class_tipo = 'limegreen;text-align:center;text-transform:uppercase';
            } elseif ($item->tipo == "saida") {
                $total_saida += $item->valor;
                $item->class_tipo = 'red;text-align:center;text-transform:uppercase';
            }


            $item->valor_formatado = number_format($item->valor, 2, ",", '.');
        }


        $total = $total_entrada - $total_saida;
        $total_entrada_br = number_format($total_entrada, 2, ",", '.');
        $total_saida_br = number_format($total_saida, 2, ",", '.');
        $total_br = number_format($total, 2, ",", '.');


        if ($total_br < '0,00') {
            $total_cor = 'red';
        } elseif ($total_br > '0,00') {
            $total_cor = 'green';
        } else {
            $total_cor = '#A9A9A9';
        }




        return view('financas.finance', compact('total_saida_br', 'financas', 'total_entrada_br', 'total_br', 'total_cor'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'nome',
            'descricao',
            'data',
            'valor',
            'tipo',
        ]);

        Finance::create($request->all());

        return redirect('/financas')->with('inserted', 'Despesa cadastrada com sucesso!');

    }


    public function destroy($id)
    {
        $financa = Finance::findOrFail($id);
        $financa->delete();

        return redirect('/financas')->with('deleted', 'Despesa excluída com sucesso!');;
    }
    public function update(Request $request, $id){
        $financas = Finance::findOrFail($id);
        $financas->update(
            [
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'data_despesa' => $request->data_despesa,
                'valor' => $request->valor,
                'tipo' => $request->tipo
            ]
        );
        return redirect('/financas')->with('edited', 'Despesa alterada com sucesso!');
    }
    public function edit($id){
        $financa = Finance::findOrFail($id);
        return view('/financas', compact('financa'));
    }

}
