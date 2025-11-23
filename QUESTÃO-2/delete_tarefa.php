<?php
require "database.php";

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id > 0) {
    mysqli_query($conexao, "DELETE FROM tarefas WHERE id = $id");
}

header("Location: index.php");
exit;
?>
