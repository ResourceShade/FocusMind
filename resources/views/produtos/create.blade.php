@extends('layouts.app')

@section('conteudo')
    <h2>Novo Produto</h2>
    <form method="POST" action="/produtos">
        @csrf
        Nome: <input type="text" name="nome"><br>
        Preço: <input type="number" name="preco" step="0.01"><br>
        <button type="submit">Salvar</button>
    </form>
@endsection