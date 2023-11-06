var btnNovoEvento = document.getElementById("btnNovoEvento");
var btnCancelar = document.getElementById("btnCancelar");
var novoEvento = document.getElementById("novoEvento");
var alertaErro = document.getElementById("alertaErro");
var inputNomeSolicitante = document.getElementById("nomeSolicitante");
var inputSetorSolicitante = document.getElementById("setorSolicitante");
var inputSala = document.getElementById("sala");
var inputAguaCafe = document.getElementById("aguaCafe");
var inputDataEvento = document.getElementById("dataEvento");
var inputHoraInicio = document.getElementById("horaInicio");
var inputHoraFim = document.getElementById("horaFim");
var inputQuantPessoas = document.getElementById("quantPessoas");
var inputWebcam = document.getElementById("webcam");
var inputComputador = document.getElementById("computador");
var inputAssunto = document.getElementById("assunto");

var btnCancelarExportacao = document.getElementById("btnCancelarExportacao");
var btnExportar = document.getElementById("btnExportar");
var btnExportarDownload = document.getElementById("btnExportarDownload");
var exportar = document.getElementById("exportar");
var inputDataInicialExportacao = document.getElementById("dataInicialExportacao"); 
var inputDataFinalExportacao = document.getElementById("dataFinalExportacao");
var alertaErroExportacao = document.getElementById("alertaErroExportacao");

var formFiltros = document.getElementById("formFiltros");
var btnEnviarFiltros = document.getElementById("btnEnviarFiltros");
var btnDataAtualFiltro = document.getElementById("btnDataAtualFiltro");
var btnSemanaAtualFiltro = document.getElementById("btnSemanaAtualFiltro");

var tabelaEventos = document.getElementById("tabelaEventos");

var listaEventos = [];

function atualizarTabelaEventos(){
    alert("Reserva efetuada!");
}

function limparNovoEvento() {
    inputNomeSolicitante.value = "";
    inputSetorSolicitante.value = "";
    inputSala.value = "";
    inputAguaCafe.value = "";
    inputDataEvento.value = "";
    inputHoraInicio.value = "";
    inputHoraFim.value = "";
    inputQuantPessoas.value = "";
    inputNomeSolicitante.classList.remove("is-invalid");
    inputSetorSolicitante.classList.remove("is-invalid");
    inputSala.classList.remove("is-invalid");
    inputAguaCafe.classList.remove("is-invalid");
    inputHoraInicio.classList.remove("is-invalid");
    inputHoraFim.classList.remove("is-invalid");
    inputQuantPessoas.classList.remove("is-invalid");
    inputDataEvento.classList.remove("is-invalid");
    alertaErro.innerHTML = "";
    alertaErro.classList.add("d-none");
}

function mostrarNovoEvento() {
    novoEvento.classList.remove("d-none");
}

function ocultarNovoEvento() {
    novoEvento.classList.add("d-none");
    limparNovoEvento();
}

function limparExportacao() {
    inputDataInicialExportacao.value = "";
    inputDataFinalExportacao.value = "";
}

function mostrarExportacao() {
    exportar.classList.remove("d-none");
}

function ocultarExportacao() {
    exportar.classList.add("d-none");
    limparExportacao();
}

function novoEventoValido(nomeSolicitante, setorSolicitante, sala, aguaCafe, dataEvento, horaInicio, horaFim, quantPessoas, webcam, computador, assunto){
    var validacaoOk = true;
    var timestampEvento = Date.parse(dataEvento);
    var timestampAtual = new Date().getTime();
    var erro = "";
   
    if(nomeSolicitante.trim().length === 0){
        erro = "Preencha o nome do solicitante.";
        inputNomeSolicitante.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputNomeSolicitante.classList.remove("is-invalid");
    }
   
    if(setorSolicitante.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Preencha o setor do solicitante.";
        inputSetorSolicitante.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputSetorSolicitante.classList.remove("is-invalid");
    }
   
    if(sala.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione a sala desejada.";
        inputSala.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputSala.classList.remove("is-invalid");
    }
   
    if(aguaCafe.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione se quer água ou café.";
        inputAguaCafe.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputAguaCafe.classList.remove("is-invalid");
    }
   
    if(horaInicio.length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione a hora de início da reunião.";
        inputHoraInicio.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputHoraInicio.classList.remove("is-invalid");
    }
   
    if(horaFim.length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione a hora de encerramento da reunião.";
        inputHoraFim.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputHoraFim.classList.remove("is-invalid");
    }

    if (horaInicio > horaFim) {
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "A hora de início deve ser menor que a hora de encerramento.";
        inputHoraInicio.classList.add("is-invalid");
        inputHoraFim.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputHoraFim.classList.remove("is-invalid");
        inputHoraInicio.classList.remove("is-invalid");
    }
   
    if(quantPessoas.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione quantas pessoas participarão da reunião.";
        inputQuantPessoas.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    }  else {
        inputQuantPessoas.classList.remove("is-invalid");
    }

    if(isNaN(timestampEvento)){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione a data da reunião.";
        inputDataEvento.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputDataEvento.classList.remove("is-invalid");
    }
   
    if(timestampEvento < timestampAtual){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "A data está no passado, altere para uma data futura.";
        inputDataEvento.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    } else {
        inputDataEvento.classList.remove("is-invalid");
    }

    if(webcam.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione a opção 'Webcam'.";
        inputWebcam.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    }  else {
        inputWebcam.classList.remove("is-invalid");
    }

    if(computador.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Selecione a opção 'Computador'.";
        inputComputador.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    }  else {
        inputComputador.classList.remove("is-invalid");
    }

    if(assunto.trim().length === 0){
        if(erro.length > 0){
            erro += ' \n';
        }
        erro += "Preencha o assunto da reunião.";
        inputAssunto.classList.add("is-invalid");
        alertaErro.classList.remove("d-none");
        validacaoOk = false;
    }  else {
        inputAssunto.classList.remove("is-invalid");
    }

    if(!validacaoOk) {
        alertaErro.innerText = erro;
    } else {
        alertaErro.classList.add("d-none");
    }

    return validacaoOk;
}

async function integrarBancoDados() {
    var formNovoEvento = document.getElementById("formNovoEvento");

    // Receber os dados do formulário
    const dadosForm = new FormData(formNovoEvento);

    //Enviar dados para o 'salvar.php'
    try {
        const resposta = await fetch("salvar.php", {
            method: "POST",
            body: dadosForm
        });

        if (resposta.ok) {
            const dados = await resposta.json();
            console.log(dados);
        } else {
            console.error("Erro ao enviar os dados para o BD");
        }
    } catch (erro) {
        console.error("Erro na requisição do servidor", erro);
    }
}

function salvarNovoEvento(event) {
    event.preventDefault();
    var nomeSolicitante = inputNomeSolicitante.value;
    var setorSolicitante = inputSetorSolicitante.value;
    var sala = inputSala.value;
    var aguaCafe = inputAguaCafe.value;
    var dataEvento = new Date (inputDataEvento.value);
    dataEvento.setDate(dataEvento.getDate() + 1);
    var dataEventoFormatado = dataEvento.toLocaleDateString();
    var horaInicio = inputHoraInicio.value;
    var horaFim = inputHoraFim.value;
    var quantPessoas = inputQuantPessoas.value;
    var webcam = inputWebcam.value;
    var computador = inputComputador.value;
    var assunto = inputAssunto.value;


    if(novoEventoValido(nomeSolicitante, setorSolicitante, sala, aguaCafe, dataEvento, horaInicio, horaFim, quantPessoas, webcam, computador, assunto)){
        console.log("Válido");
        listaEventos.push({
            nome: nomeSolicitante,
            sala: sala,
            data: dataEventoFormatado,
            horaI: horaInicio,
            horaF: horaFim,
        });

        integrarBancoDados();
        atualizarTabelaEventos();
        ocultarNovoEvento();

    }else {
        console.log("Invalido");
    }
}

btnNovoEvento.addEventListener("click", mostrarNovoEvento);
btnCancelar.addEventListener("click", ocultarNovoEvento);
btnExportar.addEventListener("click", mostrarExportacao);
btnCancelarExportacao.addEventListener("click", ocultarExportacao);
novoEvento.addEventListener("submit", salvarNovoEvento);