<?php
require "database.php";

$id = $_POST['id'];

mysqli_query($conexao, "DELETE FROM livros WHERE id=$id");

header("Location: index.php");
exit;
?>
