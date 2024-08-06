<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Painel extends Component
{
    public $totalEntradaBr;
    public $totalSaidaBr;
    public $totalCor;
    public $totalBr;

    public function __construct($totalEntradaBr, $totalSaidaBr, $totalCor, $totalBr)
    {
        $this->totalEntradaBr = $totalEntradaBr;
        $this->totalSaidaBr = $totalSaidaBr;
        $this->totalCor = $totalCor;
        $this->totalBr = $totalBr;
    }

    /**
.
     */
    public function render(): View|Closure|string
    {
        return view('components.painel');
    }
}
