<?php    
    include_once('config.php');

    if (!$conexao) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    $query_agendamento = "INSERT INTO agendamento (nomeSolicitante, setorSolicitante, sala, aguaCafe,
    dataEvento, horaInicio, horaFim, quantPessoas, webcam, computador, assunto) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $agendamento_realizado = $conexao->prepare($query_agendamento);
    if ($agendamento_realizado === false) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }
    $agendamento_realizado->bind_param('sssssssisss', $dados['nomeSolicitante'], $dados['setorSolicitante'], 
    $dados['sala'], $dados['aguaCafe'], $dados['dataEvento'], $dados['horaInicio'], $dados['horaFim'], 
    $dados['quantPessoas'], $dados['webcam'], $dados['computador'], $dados['assunto']);

    if ($agendamento_realizado->execute()) {
        $retorna = ['status' => true, 'nomeSolicitante' => $dados['nomeSolicitante']];
        echo json_encode($retorna);
    } else {
        die("Erro na execução da consulta: " . $agendamento_realizado->error);
    }

    $conexao->close();
?>