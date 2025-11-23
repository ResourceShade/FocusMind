@extends('layouts.app')

@section('conteudo')
    <h2>Lista de Produtos</h2>
    <ul>
        @foreach ($produtos as $p)
            <li>{{ $p->nome }} - R$ {{ number_format($p->preco, 2, ',', '.') }}</li>
        @endforeach
    </ul>
@endsection
