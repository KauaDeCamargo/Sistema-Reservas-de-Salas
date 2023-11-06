<?php
session_start();
include_once('config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar</title>
</head>
<body>
<?php
		//nome do arquivo que será exportado
		$arquivo = 'reservasamep.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="11" align=center><h1>RESERVAS DE SALAS DE REUNIÃO AMEP<h1></td>';
		$html .= '</tr>';
		
		//Criamos os requisitos da tabela alinhados ao centro
		$html .= '<tr>';
        $html .= '<td align=center><b>DATA</b></td>';
        $html .= '<td align=center><b>INÍCIO</b></td>';
		$html .= '<td align=center><b>FIM</b></td>';
        $html .= '<td align=center><b>SOLICITANTE</b></td>';
		$html .= '<td align=center><b>SETOR</b></td>';
		$html .= '<td align=center><b>SALA</b></td>';
		$html .= '<td align=center><b>ÁGUA/CAFÉ</b></td>';
		$html .= '<td align=center><b>PARTICIPANTES</b></td>';
		$html .= '<td align=center><b>WEBCAM</b></td>';
        $html .= '<td align=center><b>COMPUTADOR</b></td>';
        $html .= '<td align=center><b>ASSUNTO</b></td>';
		$html .= '</tr>';

		//Selecionar os itens que queremos da tabela e conectamos ao BD fazendo com que os resultados sejam ordenados na tabela por data da reunião
		$dataInicialExportacao = $_POST['dataInicialExportacao'];
		$dataFinalExportacao = $_POST['dataFinalExportacao'];
		
		$query = "SELECT dataEvento, horaInicio, horaFim, nomeSolicitante, setorSolicitante, sala, aguaCafe, quantPessoas, webcam, computador, assunto 
		FROM agendamento
		WHERE dataEvento BETWEEN '$dataInicialExportacao' AND '$dataFinalExportacao'
		ORDER BY dataEvento, sala";
		$resultado = mysqli_query($conexao, $query);
		
		while($row_resultado = mysqli_fetch_assoc($resultado)){

			$celulaHoraInicio = new DateTime($row_resultado['horaInicio']);
			$celulaHoraFim = new DateTime($row_resultado['horaFim']);
             
			$celulaHoraInicioCerto = $celulaHoraInicio->format('H:i');
			$celulaHoraFimCerto = $celulaHoraFim->format('H:i');

			$html .= '<tr>';
            $html .= '<td align=center>'.$row_resultado["dataEvento"].'</td>';
			$html .= '<td align=center>'.$celulaHoraInicioCerto.'</td>';
			$html .= '<td align=center>'.$celulaHoraFimCerto.'</td>';
			$html .= '<td align=center>'.$row_resultado["nomeSolicitante"].'</td>';
			$html .= '<td align=center>'.$row_resultado["setorSolicitante"].'</td>';
			$html .= '<td align=center>'.$row_resultado["sala"].'</td>';
			$html .= '<td align=center>'.$row_resultado["aguaCafe"].'</td>';
			$html .= '<td align=center>'.$row_resultado["quantPessoas"].'</td>';
            $html .= '<td align=center>'.$row_resultado["webcam"].'</td>';
            $html .= '<td align=center>'.$row_resultado["computador"].'</td>';
            $html .= '<td align=center>'.$row_resultado["assunto"].'</td>';
            $html .= '</tr>';

		}
        
		// Configurações header para forçar o download (padrão)
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		
        // Envia o conteúdo do arquivo
		echo $html;
		exit;
		?>
    
</body>
</html>