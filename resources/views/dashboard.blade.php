@extends('layouts.app')

@section('conteudo')
<h1>Dashboard</h1>

<p>Bem-vindo ao FocusMind!</p>

<div>
    <a href="/tarefas">Ir para Tarefas</a><br>
    <a href="/timer">Ir para Timer</a><br>
    <a href="/grupos">Ir para Grupos</a>
</div>
@endsection
