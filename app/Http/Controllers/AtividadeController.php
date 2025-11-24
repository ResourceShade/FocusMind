<?php

namespace AppHttpControllers;

use IlluminateHttpRequest;

class AtividadeController extends Controller
{
    public function index()
    {
        $atividades = [
            ['titulo' => 'Organizar o dia', 'descricao' => 'Liste suas tarefas para hoje e defina prioridades.'],
            ['titulo' => 'Exercício físico', 'descricao' => 'Faça uma caminhada de 30 minutos para melhorar o foco.'],
            ['titulo' => 'Meditação', 'descricao' => 'Pratique 10 minutos de meditação para reduzir ansiedade.'],
            ['titulo' => 'Pausas regulares', 'descricao' => 'Faça pausas de 5 minutos a cada hora de trabalho.'],
        ];

        return view('atividades.index', compact('atividades'));
    }
}
