@extends('layouts.app')

@section('conteudo')
    <h1>Lista de Cursos</h1>
    @php
        $cursos = ['PHP', 'JavaScript', 'Laravel'];
    @endphp
    <ul>
        @foreach($cursos as $curso)
            <li>{{ $curso }}</li>
        @endforeach
    </ul>


    <h1>Página Inicial</h1>
    <p>Bem-vindo ao site exemplo com Lavrel!</p>
    <x-alerta mensagem="Dados salvos com sucesso!" />
@endsection