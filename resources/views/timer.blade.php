@extends('layouts.app')

@section('conteudo')
<link rel="stylesheet" href="/css/estilo.css">

<h1>Timer Simples</h1>

<div style="margin-top: 20px;">

    <!-- Entrada de tempo como texto normal -->
    <label>Tempo (MMSS):</label>
    <input id="tempo" maxlength="4" placeholder="0000" style="width: 80px;">

    <br><br>

    <!-- Botões -->
    <button onclick="iniciar()">Iniciar</button>
    <button onclick="pausar()">Pausar</button>
    <button onclick="resetar()">Reset</button>

    <h2 id="display" style="font-size: 40px; margin-top: 20px;">
        00:00
    </h2>
</div>

<!-- POPUP -->
<div id="popup" style="
    display: none;
    position: fixed;
    left: 0; top: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
">
    <div style="
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        text-align: center;
    ">
        <h2>Tempo finalizado!</h2>
        <button onclick="pararAlarme()">Parar alarme</button>
    </div>
</div>

<!-- ÁUDIO REAL -->
<audio id="alarme" preload="auto">
    <source src="/alarme.mp3" type="audio/mpeg">
</audio>

<script>
let totalSegundos = 0;
let intervalo = null;

// -------------- EXIBE O TEMPO --------------
function atualizarDisplay() {
    let m = String(Math.floor(totalSegundos / 60)).padStart(2, '0');
    let s = String(totalSegundos % 60).padStart(2, '0');
    document.getElementById('display').innerText = `${m}:${s}`;
}

// -------------- INICIAR --------------
function iniciar() {
    if (intervalo !== null) return;

    let val = document.getElementById("tempo").value.trim();

    if (val.length === 0 || val.length > 4) {
        alert("Digite entre 1 e 4 dígitos, exemplo: 45 → 00:45 | 120 → 01:20");
        return;
    }

    // completa com zeros à esquerda
    while (val.length < 4) val = "0" + val;

    let min = parseInt(val.substring(0, 2));
    let seg = parseInt(val.substring(2, 4));

    totalSegundos = (min * 60) + seg;

    if (totalSegundos <= 0) {
        alert("Digite um tempo válido.");
        return;
    }

    atualizarDisplay();

    intervalo = setInterval(() => {
        totalSegundos--;
        atualizarDisplay();

        if (totalSegundos <= 0) {
            pausar();
            tocarAlarme();
            mostrarPopup();
        }
    }, 1000);
}

// -------------- PAUSAR --------------
function pausar() {
    clearInterval(intervalo);
    intervalo = null;
}

// -------------- RESET --------------
function resetar() {
    pausar();
    totalSegundos = 0;
    atualizarDisplay();
}

// -------------- POPUP --------------
function mostrarPopup() {
    document.getElementById("popup").style.display = "flex";
}

function fecharPopup() {
    document.getElementById("popup").style.display = "none";
}

// -------------- ALARME REAL --------------
function tocarAlarme() {
    let audio = document.getElementById("alarme");
    audio.loop = true;
    audio.play();
}

function pararAlarme() {
    let audio = document.getElementById("alarme");
    audio.pause();
    audio.currentTime = 0;
    fecharPopup();
}
</script>
@endsection
