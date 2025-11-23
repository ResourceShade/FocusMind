<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index() {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function store() {
        Produto::create([
            'nome' => 'Teclado',
            'preco' => 120.00
        ]);
        return redirect('/produtos');
    }

    public function create()
    {
        Produto::create($request->all());
        return redirect('/produtos');
    }
}
