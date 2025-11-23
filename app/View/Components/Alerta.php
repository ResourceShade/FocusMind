<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alerta extends Component
{
    public $mensagem;
    public function __construct($mensagem = null)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alerta');
    }
}
