<?php
require "database.php";

$titulo = $_POST['titulo'];
$autor  = $_POST['autor'];
$ano    = $_POST['ano'];

if ($titulo != "" && $autor != "" && $ano != "") {
    $sql = "INSERT INTO livros (titulo, autor, ano) VALUES ('$titulo', '$autor', '$ano')";
    mysqli_query($conexao, $sql);
}

header("Location: index.php");
exit;
?>
