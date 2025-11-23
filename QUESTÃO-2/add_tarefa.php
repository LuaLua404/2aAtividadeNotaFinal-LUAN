<?php
require "database.php";

$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$vencimento = isset($_POST['vencimento']) ? $_POST['vencimento'] : '';

if ($descricao != "" && $vencimento != "") {

    $sql = "INSERT INTO tarefas (descricao, vencimento, concluida) 
            VALUES ('$descricao', '$vencimento', 0)";

    mysqli_query($conexao, $sql);
}

header("Location: index.php");
exit;
?>