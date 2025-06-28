<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function index()
    {
        $financas = Finance::all();
        $totais = $this->calcularTotais($financas);

        return view('financas.finance', [
            'financas' => $financas,
            'totalEntradaBr' => $totais['entrada'],
            'totalSaidaBr' => $totais['saida'],
            'totalBr' => $totais['liquido'],
            'totalCor' => $totais['cor'],
        ]);
    }


    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        Finance::create($validated);

        return redirect('/financas')->with('success', 'Despesa cadastrada com sucesso!');
    }

    public function destroy(Finance $financa)
    {
        $financa->delete();
        return redirect('/financas')->with('success', 'Despesa excluída com sucesso!');
    }

    public function edit(Finance $financa)
    {
        return view('financas.edit', compact('financa'));
    }

    public function update(Request $request, Finance $financa)
    {
        $validated = $this->validateRequest($request);
        $financa->update($validated);

        return redirect('/financas')->with('success', 'Despesa alterada com sucesso!');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data' => 'required|date',
            'valor' => 'required|numeric|min:0.01',
            'tipo' => 'required|in:entrada,saida'
        ]);
    }

    private function calcularTotais($financas)
    {
        $totais = [
            'entrada' => 0,
            'saida' => 0,
        ];

        $financas->each(function ($item) use (&$totais) {
            $item->valor_formatado = number_format($item->valor, 2, ',', '.');

            if ($item->tipo === 'entrada') {
                $totais['entrada'] += $item->valor;
                $item->class_tipo = 'limegreen';
            } elseif ($item->tipo === 'saida') {
                $totais['saida'] += $item->valor;
                $item->class_tipo = 'red';
            }
        });

        $totalLiquido = $totais['entrada'] - $totais['saida'];

        return [
            'entrada' => number_format($totais['entrada'], 2, ',', '.'),
            'saida' => number_format($totais['saida'], 2, ',', '.'),
            'liquido' => number_format($totalLiquido, 2, ',', '.'),
            'cor' => $this->getCorTotal($totalLiquido),
        ];
    }

    private function getCorTotal($valor)
    {
        return match (true) {
            $valor < 0 => 'red',
            $valor > 0 => 'green',
            default => '#A9A9A9',
        };
    }
}
