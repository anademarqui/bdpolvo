<?php
$servidor = "localhost";
$usuario = "SEU_USUARIO_AQUI";
$senha = "SUA_SENHA_AQUI";
$banco = "NOME_DO_BANCO";

$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

?>