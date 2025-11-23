<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "livraria";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha ao se conectar com o Banco de Dados: " . mysqli_connect_error());
}
?>