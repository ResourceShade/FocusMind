@extends('layouts.app')

@section('title', 'Atividades FocusMind')

@section('content')
    <h1>Atividades para ajudar com TDAH e Ansiedade</h1>

    <ul>
        @foreach ($atividades as $atividade)
            <li>
                <h3>{{ $atividade['titulo'] }}</h3>
                <p>{{ $atividade['descricao'] }}</p>
            </li>
        @endforeach
    </ul>
@endsection
