@extends('layouts.app')

@section('conteudo')
<link rel="stylesheet" href="/css/estilo.css">

<style>
/* LAYOUT GERAL */
#container {
    display: flex;
    height: calc(100vh - 60px);
}

/* SIDEBAR */
#sidebar {
    width: 220px;
    background: #f7f7f7;
    padding: 20px;
    border-right: 1px solid #ddd;
}

#sidebar h3 {
    margin-top: 0;
}

.lista-item {
    padding: 8px;
    margin-bottom: 5px;
    border-radius: 6px;
    cursor: pointer;
}

.lista-item:hover {
    background: #eaeaea;
}

.lista-item.ativo {
    background: #d0d0d0;
    font-weight: bold;
}

/* BOTÃO NOVA LISTA */
#btnNovaLista {
    margin-top: 20px;
    padding: 8px;
    background: #ddd;
    border: none;
    width: 100%;
    cursor: pointer;
    border-radius: 6px;
}
#btnNovaLista:hover {
    background: #ccc;
}

/* ÁREA PRINCIPAL */
#conteudo {
    flex: 1;
    padding: 25px;
}

/* TÍTULO DA LISTA */
#tituloListaAtual {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
}

/* TAREFAS */
.tarefa {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.tarefa input[type="checkbox"] {
    margin-right: 10px;
}

/* texto estilo Notion */
.tarefa-nome {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
}

.tarefa-acoes {
    margin-left: 10px;
    cursor: pointer;
    font-size: 20px;
    user-select: none;
}

/* MODAL */
.modal {
    display:none;
    position: fixed;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
}
</style>

<div id="container">

    <!-- SIDEBAR -->
    <div id="sidebar">
        <h3>Listas</h3>

        <div id="listas"></div>

        <button id="btnNovaLista" onclick="abrirModalLista()">+ Nova lista</button>
    </div>

    <!-- ÁREA PRINCIPAL -->
    <div id="conteudo">
        <div id="tituloListaAtual">Geral</div>

        <button onclick="abrirModalCriar()" style="margin-bottom:15px;">
            + Adicionar tarefa
        </button>

        <div id="tarefas"></div>
    </div>

</div>

<!-- MODAL CRIAR TAREFA -->
<div id="modalCriar" class="modal">
    <div class="modal-content">
        <h2>Nova tarefa</h2>

        <label>Nome da tarefa:</label>
        <input id="tNome" style="width:100%; margin-bottom:10px;">

        <label>Descrição:</label>
        <textarea id="tDesc" style="width:100%; height:60px;"></textarea>

        <br><br>

        <label>Prazo (opcional):</label>
        <input id="tData" type="date" style="width:100%; margin-top:5px;">
        <input id="tHora" type="time" style="width:100%; margin-top:5px;">

        <div style="margin-top:15px;">
            <button onclick="salvarTarefa()">Adicionar</button>
            <button onclick="fecharModalCriar()">Cancelar</button>
        </div>
    </div>
</div>

<!-- MODAL NOVA LISTA -->
<div id="modalLista" class="modal">
    <div class="modal-content">
        <h2>Nova lista</h2>

        <label>Nome da lista:</label>
        <input id="listaNome" style="width:100%; margin-bottom:10px;">

        <div style="margin-top:10px;">
            <button onclick="criarLista()">Criar</button>
            <button onclick="fecharModalLista()">Cancelar</button>
        </div>
    </div>
</div>


<script>
// -------- LISTAS ---------
let listas = ["Geral"];
let listaAtual = 0;

let tarefas = {
    "Geral": []
};

function abrirModalLista() {
    document.getElementById("listaNome").value = "";
    document.getElementById("modalLista").style.display = "flex";
}

function fecharModalLista() {
    document.getElementById("modalLista").style.display = "none";
}

function criarLista() {
    let nome = document.getElementById("listaNome").value.trim();
    if (!nome) {
        alert("Digite o nome da lista.");
        return;
    }

    listas.push(nome);
    tarefas[nome] = [];

    fecharModalLista();
    renderListas();
}


function renderListas() {
    let html = "";
    listas.forEach((nome, i) => {
        html += `
        <div class="lista-item ${i===listaAtual ? 'ativo' : ''}" 
             onclick="selecionarLista(${i})">
            ${nome}
        </div>`;
    });
    document.getElementById("listas").innerHTML = html;
}

function selecionarLista(i) {
    listaAtual = i;
    document.getElementById("tituloListaAtual").innerHTML = listas[i];
    renderListas();
    renderTarefas();
}

// -------- UTILITÁRIO: DATA HUMANIZADA ---------
function formatarDataHumanizada(dateObj) {
    if (!dateObj) return "";

    let agora = new Date();
    let diffDias = Math.floor((dateObj - agora) / (1000 * 60 * 60 * 24));
    let hora = dateObj.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    if (diffDias === 0) return `Hoje às ${hora}`;
    if (diffDias === 1) return `Amanhã às ${hora}`;
    if (diffDias > 1) return `Daqui ${diffDias} dias`;
    if (diffDias === -1) return `Ontem às ${hora}`;

    return `Atrasada há ${Math.abs(diffDias)} dias`;
}

// -------- MODAIS --------
function abrirModalCriar() {
    document.getElementById("tNome").value = "";
    document.getElementById("tDesc").value = "";
    document.getElementById("tData").value = "";
    document.getElementById("tHora").value = "";
    document.getElementById("modalCriar").style.display = "flex";
}

function fecharModalCriar() {
    document.getElementById("modalCriar").style.display = "none";
}

// -------- CRIAR TAREFA --------
function salvarTarefa() {
    let nome = document.getElementById("tNome").value.trim();
    let desc = document.getElementById("tDesc").value.trim();
    let data = document.getElementById("tData").value;
    let hora = document.getElementById("tHora").value;

    if (!nome) {
        alert("Digite um nome para a tarefa.");
        return;
    }

    let prazo = null;
    let prazoTexto = "";

    if (data && hora) {
        prazo = new Date(`${data}T${hora}:00`);
        prazoTexto = formatarDataHumanizada(prazo);
    }

    let nomeLista = listas[listaAtual];

    if (!tarefas[nomeLista]) tarefas[nomeLista] = [];

    tarefas[nomeLista].push({
        nome,
        descricao: desc,
        prazo,
        prazoTexto,
        feito: false
    });

    fecharModalCriar();
    renderTarefas();
}

// -------- EXIBIR DETALHES --------
function abrirDetalhes(tarefa) {
    let mensagem = `Descrição:\n${tarefa.descricao || "(vazia)"}`;

    if (tarefa.prazo) {
        mensagem += `\n\nPrazo: ${tarefa.prazo.toLocaleString()}`;
    }

    alert(mensagem);
}

// -------- ALTERAR ESTADO --------
function toggleFeito(lista, i) {
    tarefas[lista][i].feito = !tarefas[lista][i].feito;
    renderTarefas();
}

function excluirTarefa(lista, i) {
    tarefas[lista].splice(i, 1);
    renderTarefas();
}

// -------- RENDER TAREFAS --------
function renderTarefas() {
    let nomeLista = listas[listaAtual];
    let lista = tarefas[nomeLista];

    if (!lista) lista = tarefas[nomeLista] = [];

    let html = "";

    lista.forEach((t, i) => {
        let atrasada = false;

        if (t.prazo && new Date() > t.prazo && !t.feito) {
            atrasada = true;
        }

        html += `
        <div class="tarefa">
            <input type="checkbox"
                   ${t.feito ? "checked" : ""}
                   onclick="toggleFeito('${nomeLista}', ${i})"
            >

            <span class="tarefa-nome ${atrasada ? 'tarefa-atrasada' : ''}"
                  onclick="abrirDetalhes(tarefas['${nomeLista}'][${i}])">
                ${t.nome}
            </span>

            <span style="font-size: 12px; margin-right: 10px; color: ${atrasada ? 'red' : '#555'};">
                ${t.prazoTexto || ""}
            </span>

            <span class="tarefa-acoes"
                  onclick="excluirTarefa('${nomeLista}',${i})">×</span>
        </div>`;
    });

    document.getElementById("tarefas").innerHTML = html;
}

// ---- Inicializar ----
renderListas();
renderTarefas();
</script>

@endsection
