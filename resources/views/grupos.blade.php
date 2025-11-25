@extends('layouts.app')

@section('conteudo')
<link rel="stylesheet" href="/css/estilo.css">

<h1>Grupos</h1>

<input id="grupo" placeholder="Nome do grupo">
<button onclick="adicionar()">Criar</button>

<ul id="lista"></ul>

<script>
let grupos = [];

function adicionar(){
    let nome = document.getElementById('grupo').value;
    if(!nome) return alert('Digite um nome');
    grupos.push(nome);
    render();
}

function render(){
    document.getElementById('lista').innerHTML =
        grupos.map(g => `<li>${g}</li>`).join('');
}
</script>
@endsection
