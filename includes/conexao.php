<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "polvo";
$porta = "3306";

$mysqli = new mysqli($servidor, $usuario, $senha, $banco, $porta);

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

?>