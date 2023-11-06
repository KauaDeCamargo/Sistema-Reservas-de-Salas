<?php
// Configurações de conexão com o banco de dados
$host = "localhost"; // Host do banco de dados
$usuario = "root"; // Nome de usuário do banco de dados
$senha = ""; // Senha do banco de dados
$banco = "agendamentodb"; // Nome do banco de dados

// Conexão com o banco de dados
$conexao = mysqli_connect($host, $usuario, $senha, $banco, 3307); /*mysqli_select_db($conexao, $banco) or die( 'Não foi possível conectar ao banco MySQL');
if (!$conexao) {echo 'Não foi possível conectar ao banco MySQL.'; exit;}
else {echo 'Parabéns!! A conexão ao banco de dados ocorreu normalmente!.';}*/
?>