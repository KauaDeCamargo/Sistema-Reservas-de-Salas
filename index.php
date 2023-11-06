<?php
  include_once('config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Reserva de Salas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="row">
      <div class="col">
        <h1>Reserva de Salas</h1>
      </div>
    </div>

    <!-- PAINEL AGENDAMENTO -->
    <div id="novoEvento" class="row my-2 mx-1 py-2 border rounded d-none">
      <div class="col-12">
        <form id="formNovoEvento">
          <div class="row">
            <div class="col-12">
              <h2>Novo Agendamento</h2>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-6">
              <label for="nomeSolicitante" class="form-label">Solicitante</label>
              <input type="text" name="nomeSolicitante" id="nomeSolicitante" class="form-control" placeholder="Nome Completo">
            </div>
            <div class="col-6">
              <label for="setorSolicitante" class="form-label">Setor</label>
              <input type="text" name="setorSolicitante" id="setorSolicitante" class="form-control" placeholder="Setor">
            </div>
            <div class="col-6">
              <label for="sala" class="form-label">Sala</label>
              <select type="text" name="sala" id="sala" class="form-select">
                <option selected value="">Escolha</option>
                <option value="Sala 1">Sala de Reunião 1</option>
                <option value="Sala 2">Sala de Reunião 2</option>
                <option value="Sala 3">Sala de Reunião 3</option>
              </select>
            </div>
            <div class="col-6">
              <label for="aguaCafe" class="form-label">Água/Café</label>
              <select type="text" name="aguaCafe" id="aguaCafe" class="form-select">
                <option selected value="">Escolha</option>
                <option>Sem Água e sem café</option>
                <option>Apenas água</option>
                <option>Apenas café</option>
                <option>Café e água</option>
              </select>
            </div>
            <div class="col-3">
              <label for="dataEvento" class="form-label">Data</label>
              <input type="date" name="dataEvento" id="dataEvento" class="form-control">
            </div>
            <div class="col-3">
              <label for="horaInicio" class="form-label">Início</label>
              <input type="time" name="horaInicio" id="horaInicio" class="form-control" min="07:00" max="18:30">
            </div>
            <div class="col-3">
              <label for="horaFim" class="form-label">Encerramento</label>
              <input type="time" name="horaFim" id="horaFim" class="form-control" min="07:30" max="19:00">
            </div>
            <div class="col-3">
              <label for="quantPessoas" class="form-label">Quantas pessoas participarão?</label>
              <input type="text" name="quantPessoas" id="quantPessoas" class="form-control" placeholder="0">
            </div>
            <div class="col-4">
              <label for="webcam" class="form-label">Webcam</label>
              <select type="text" name="webcam" id="webcam" class="form-select">
                <option selected value="">Escolha</option>
                <option>Sim</option>
                <option>Não</option>
              </select>
            </div>
            <div class="col-4">
              <label for="computador" class="form-label">Computador</label>
              <select type="text" name="computador" id="computador" class="form-select">
                <option selected value="">Escolha</option>
                <option>Sim</option>
                <option>Não</option>
              </select>
            </div>
            <div class="col-4">
              <label for="assunto" class="form-label">Assunto</label>
              <input name="assunto" id="assunto" class="form-control">
            </div>
            <div class="col-12">
              <div class="alert alert-danger d-none" id="alertaErro" role="alert">
                Mensagem de erro!
              </div>
            </div>

            <div class="col-6"><button type="button" class="btn btn-danger w-100" id="btnCancelar">Cancelar</button></div>
            <div class="col-6"><button type="submit" name="submit" class="btn btn-primary w-100">Salvar</button></div>
          </div>
        </form>
      </div>
    </div>

    <!-- PAINEL EXPORTAR -->
    <div id="exportar" class="row my-2 mx-1 py-2 border rounded d-none">
      <div class="col-12">
        <form method="POST" action="exportar.php" id="formExportacao">
          <div class="row">
            <div class="col-12">
              <h2>Exportar Relatório</h2>
            </div>
            <div class="col-12">
              <p>Determine o intevalo de datas que você deseja exportar</p>
            </div>
          </div>
          <div class="row g-3">
            <div class="col-6">
              <label for="dataInicialExportacao" class="form-label">Data Inicial</label>
              <input type="date" name="dataInicialExportacao" id="dataInicialExportacao" class="form-control" required>
            </div>
            <div class="col-6">
              <label for="dataFinalExportacao" class="form-label">Data Final</label>
              <input type="date" name="dataFinalExportacao" id="dataFinalExportacao" class="form-control" required>
            </div>
            <div class="col-6"><button type="button" class="btn btn-danger w-100" id="btnCancelarExportacao">Cancelar</button></div>
            <div class="col-6"><button type="submit" class="btn btn-primary w-100" id="btnExportarDownload" value="exportar">Exportar</button></div>
          </div>
        </form>
      </div>
    </div>

    <!-- RELATÓRIO DE AGENDAMENTOS -->
    <div class="row">
      <div class="col">
        <h2>
          Agendamentos
        </h2>
      </div>
      <div class="col-auto">
        <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltros" aria-controls="offcanvasRight">Filtrar Agendamentos</button>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFiltros" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel">Selecione o filtro para visualizar os agendamentos já existentes!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="row">
            <div class="col-6">
              <form method="POST">
                <button type="submit" class="btn btn-success" id="btnDataAtualFiltro" name="btnDataAtualFiltro">Data atual</button>
            </div>
            <div class="col-6">
              <button type="submit" class="btn btn-success" id="btnSemanaAtualFiltro" name="btnSemanaAtualFiltro">Semana atual</button>
            </div>
              </form>
          </div>
          <form method="POST" id="formFiltros">
            <div class="row">
              <div class="mt-3">
                <p><strong>Intervalo de datas:</strong></p>
              </div>
              <div class="col-6">
                <label for="dataInicialFiltro" class="form-label">De:</label>
                <input type="date" name="dataInicialFiltro" id="dataInicialFiltro" class="form-control">
              </div>
              <div class="col-6">
                <label for="dataFinalFiltro" class="form-label">Até:</label>
                <input type="date" name="dataFinalFiltro" id="dataFinalFiltro" class="form-control">
              </div>
              <div class="col-auto mt-3">
                <button type="submit" class="btn btn-primary" id="btnEnviarIntervaloDatas" name="btnEnviarIntervaloDatas" data-bs-dismiss="offcanvas" aria-label="Close">Filtrar</button>
              </div>
            </form>
              <div class="mt-3">
                <p><strong>Por sala:</strong></p>
              </div>
              <div class="col-12">
                <label for="salaFiltro" class="form-label">Sala:</label>
                <select type="text" name="salaFiltro" id="salaFiltro" class="form-select">
                  <option selected value="">Escolha</option>
                  <option value="Sala 1">Sala 1</option>
                  <option value="Sala 2">Sala 2</option>
                  <option value="Sala 3">Sala 3</option>
                </select>
              </div>
              <div class="col-auto mt-3">
                <button type="submit" class="btn btn-primary" id="btnEnviarSalaFiltro" name="btnEnviarSalaFiltro" data-bs-dismiss="offcanvas" aria-label="Close">Filtrar</button>
              </div>
            </div>
        </div>
      </div>
      </div>
      
      <div class="col-auto">
        <button type="button" class="btn btn-success" id="btnNovoEvento">Novo Agendamento</button>
      </div>
      <div class="col-auto">
        <button type="button" class="btn btn-success" id="btnExportar">Exportar Relatório</button>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Solicitante</th>
              <th scope="col">Sala</th>
              <th scope="col">Data</th>
              <th scope="col">Hora Início</th>
              <th scope="col">Hora Fim</th>
            </tr>
          </thead>
          <tbody id="tabelaEventos">
            <?php

              $hoje = date('Y-m-d');

              $segunda = date('Y-m-d', strtotime("last Monday"));
              $sexta = date('Y-m-d', strtotime("next Friday"));
              
              // FILTRAGEM DATA ATUAL
              if(isset($_POST['btnDataAtualFiltro'])){
                $sql = "SELECT nomeSolicitante, sala, dataEvento, horaInicio, horaFim 
                FROM agendamento
                WHERE dataEvento = '$hoje'
                ORDER BY dataEvento, sala";

                $result = $conexao->query($sql);
                if(mysqli_num_rows($result) == 0){
                  echo "<tr>";
                  echo "<td>Nenhum agendamento filtrado!</td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";
                } else {
                  while($user_data = mysqli_fetch_assoc($result)){
                
                    $celulaDataEvento = new DateTime($user_data['dataEvento']);
                    $celulaHoraInicio = new DateTime($user_data['horaInicio']);
                    $celulaHoraFim = new DateTime($user_data['horaFim']);
    
                    $celulaDataEventoCerto = $celulaDataEvento->format('d/m/Y');             
                    $celulaHoraInicioCerto = $celulaHoraInicio->format('H:i');
                    $celulaHoraFimCerto = $celulaHoraFim->format('H:i');
    
                    echo "<tr>";
                    echo "<td>".$user_data['nomeSolicitante']."</td>";
                    echo "<td>".$user_data['sala']."</td>";
                    echo "<td>".$celulaDataEventoCerto."</td>";
                    echo "<td>".$celulaHoraInicioCerto."</td>";
                    echo "<td>".$celulaHoraFimCerto."</td>";
                    echo "</tr>";
    
                  }
                }
              } elseif(isset($_POST['btnSemanaAtualFiltro'])){ // FILTRAGEM SEMANA ATUAL
                $sql = "SELECT nomeSolicitante, sala, dataEvento, horaInicio, horaFim 
                FROM agendamento
                WHERE dataEvento BETWEEN '$segunda' AND '$sexta'
                ORDER BY dataEvento, sala";

                $result = $conexao->query($sql);
                if(mysqli_num_rows($result) == 0){
                  echo "<tr>";
                  echo "<td>Nenhum agendamento filtrado!</td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";
                } else {
                  while($user_data = mysqli_fetch_assoc($result)){
                  
                    $celulaDataEvento = new DateTime($user_data['dataEvento']);
                    $celulaHoraInicio = new DateTime($user_data['horaInicio']);
                    $celulaHoraFim = new DateTime($user_data['horaFim']);
    
                    $celulaDataEventoCerto = $celulaDataEvento->format('d/m/Y');             
                    $celulaHoraInicioCerto = $celulaHoraInicio->format('H:i');
                    $celulaHoraFimCerto = $celulaHoraFim->format('H:i');
    
                    echo "<tr>";
                    echo "<td>".$user_data['nomeSolicitante']."</td>";
                    echo "<td>".$user_data['sala']."</td>";
                    echo "<td>".$celulaDataEventoCerto."</td>";
                    echo "<td>".$celulaHoraInicioCerto."</td>";
                    echo "<td>".$celulaHoraFimCerto."</td>";
                    echo "</tr>";
                  }
  
                }
              } elseif(isset($_POST['btnEnviarIntervaloDatas'])){ // FILTRAGEM INTERVALO DE DATAS
                $dataInicialFiltro = $_POST['dataInicialFiltro'];
                $dataFinalFiltro = $_POST['dataFinalFiltro'];
                $mensagem = 'A data de início deve ser menor que a data final do filtro.';

                if ($dataInicialFiltro > $dataFinalFiltro) {
                  echo "<script language='javascript'>";
                  echo "alert('".$mensagem."');";
                  echo "</script>";
                }

                $sql = "SELECT nomeSolicitante, sala, dataEvento, horaInicio, horaFim 
                FROM agendamento
                WHERE dataEvento BETWEEN '$dataInicialFiltro' AND '$dataFinalFiltro'
                ORDER BY dataEvento, sala";

                $result = $conexao->query($sql);

                if(mysqli_num_rows($result) == 0){
                  echo "<tr>";
                  echo "<td>Nenhum agendamento filtrado!</td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";
                } else {
                    while($user_data = mysqli_fetch_assoc($result)){
                  
                      $celulaDataEvento = new DateTime($user_data['dataEvento']);
                      $celulaHoraInicio = new DateTime($user_data['horaInicio']);
                      $celulaHoraFim = new DateTime($user_data['horaFim']);
    
                      $celulaDataEventoCerto = $celulaDataEvento->format('d/m/Y');             
                      $celulaHoraInicioCerto = $celulaHoraInicio->format('H:i');
                      $celulaHoraFimCerto = $celulaHoraFim->format('H:i');
    
                      echo "<tr>";
                      echo "<td>".$user_data['nomeSolicitante']."</td>";
                      echo "<td>".$user_data['sala']."</td>";
                      echo "<td>".$celulaDataEventoCerto."</td>";
                      echo "<td>".$celulaHoraInicioCerto."</td>";
                      echo "<td>".$celulaHoraFimCerto."</td>";
                      echo "</tr>";
    
                    }
                }
              } elseif(isset($_POST['btnEnviarSalaFiltro'])){ // FILTRAGEM POR SALA
                $salaFiltro = $_POST['salaFiltro'];
                
                $sql = "SELECT nomeSolicitante, sala, dataEvento, horaInicio, horaFim 
                FROM agendamento
                WHERE sala = '$salaFiltro' AND dataEvento >= '$hoje'
                ORDER BY dataEvento, sala";

                $result = $conexao->query($sql);

                if(mysqli_num_rows($result) == 0){
                  echo "<tr>";
                  echo "<td>Nenhum agendamento filtrado!</td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "<td></td>";
                  echo "</tr>";
                } else {
                    while($user_data = mysqli_fetch_assoc($result)){
                  
                      $celulaDataEvento = new DateTime($user_data['dataEvento']);
                      $celulaHoraInicio = new DateTime($user_data['horaInicio']);
                      $celulaHoraFim = new DateTime($user_data['horaFim']);
    
                      $celulaDataEventoCerto = $celulaDataEvento->format('d/m/Y');             
                      $celulaHoraInicioCerto = $celulaHoraInicio->format('H:i');
                      $celulaHoraFimCerto = $celulaHoraFim->format('H:i');
    
                      echo "<tr>";
                      echo "<td>".$user_data['nomeSolicitante']."</td>";
                      echo "<td>".$user_data['sala']."</td>";
                      echo "<td>".$celulaDataEventoCerto."</td>";
                      echo "<td>".$celulaHoraInicioCerto."</td>";
                      echo "<td>".$celulaHoraFimCerto."</td>";
                      echo "</tr>";
    
                    }
                }
              } else { // QUERY PADRÃO PARA VER AGENDAMENTOS A PARTIR DE HOJE
                $sql = "SELECT nomeSolicitante, sala, dataEvento, horaInicio, horaFim 
                FROM agendamento
                WHERE dataEvento >= '$hoje'
                ORDER BY dataEvento, sala";

                $result = $conexao->query($sql);

                while($user_data = mysqli_fetch_assoc($result)){
                  
                  $celulaDataEvento = new DateTime($user_data['dataEvento']);
                  $celulaHoraInicio = new DateTime($user_data['horaInicio']);
                  $celulaHoraFim = new DateTime($user_data['horaFim']);

                  $celulaDataEventoCerto = $celulaDataEvento->format('d/m/Y');             
                  $celulaHoraInicioCerto = $celulaHoraInicio->format('H:i');
                  $celulaHoraFimCerto = $celulaHoraFim->format('H:i');

                  echo "<tr>";
                  echo "<td>".$user_data['nomeSolicitante']."</td>";
                  echo "<td>".$user_data['sala']."</td>";
                  echo "<td>".$celulaDataEventoCerto."</td>";
                  echo "<td>".$celulaHoraInicioCerto."</td>";
                  echo "<td>".$celulaHoraFimCerto."</td>";
                  echo "</tr>";

                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="agenda.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>