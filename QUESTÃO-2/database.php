<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "gerenciador_tarefas";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro ao se conectar com o Banco de Dados: " . $conexao->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    vencimento DATE NOT NULL,
    concluida INT DEFAULT 0
)";

$conexao->query($sql);
?>