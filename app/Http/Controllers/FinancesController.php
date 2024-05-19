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


        $total_entrada = 0;
        foreach ($financas as $item) {
            if ($item->tipo == "entrada") {
                $total_entrada += $item->valor;
            }
        }

        $total_saida = 0;
        foreach ($financas as $item) {
            if ($item->tipo == "saida") {
                $total_saida += $item->valor;
            }
        }

        $total = $total_entrada - $total_saida;
        $total_entrada_br = number_format($total_entrada, 2, ",", '.');
        $total_saida_br = number_format($total_saida, 2, ",", '.');
        $total_br = number_format($total, 2, ",", '.');


        return view('financas.finance', compact('total_saida_br', 'financas', 'total_entrada_br', 'total_br'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'nome',
            'descricao',
            'valor',
            'tipo',
        ]);

        Finance::create($request->all());

        return redirect('/financas')->with('success', 'Finance record created successfully!');
    }

    public function destroy($id)
    {
        $financa = Finance::findOrFail($id);
        $financa->delete();

        return redirect('/financas')->with('success', 'Finance record deleted successfully!');
    }

}
