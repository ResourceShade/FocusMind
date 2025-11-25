<?php

namespace App\Http\Controllers;

class PaginasController extends Controller
{
    public function dashboard()    { return view('dashboard'); }
    public function tarefas()      { return view('tarefas'); }
    public function timer()        { return view('timer'); }
    public function grupos()       { return view('grupos'); }

    public function sobre()        { return view('sobre'); }
    public function colaboracao()  { return view('contato'); }
}
