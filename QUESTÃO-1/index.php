<?php
require "database.php";


$sql = "SELECT * FROM livros ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Questão 1 -Livraria</title>

    <style>
        body {
            background: yellow;
            margin: 0;
            padding: 20px;
        }

        .corpo {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 6px;
        }

        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-bottom: 18px;
        }

        input {
            padding: 9px;
            margin: 4px;
            width: 222px;
        }

        button {
            padding: 8px 14px;
            cursor: pointer;
            margin-top: 11px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            margin-top: 17px;
            border: 1px solid #bbb;
        }

        th {
            padding: 8px;
            text-align: left;
            background: #eee;
        }

        td {
            padding: 8px;
            text-align: left;
            background: #eee;
        }

        .deleteBook {
            background: #d9534e;
            color: #fafafa;
            border: none;
        }

        .deleteBook:hover {
            background: #c9302e;
        }
    </style>
</head>

<body>

    <div class="corpo">

        <h1>Livraria</h1>

        <h2>Cadastre seu Livro abaixo</h2>

        <form action="add_book.php" method="POST" id="formAdd">
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="text" name="autor" placeholder="Autor" required>
            <input type="number" name="ano" placeholder="Ano" required>
            <br>
            <button>Adicionar</button>
        </form>

        <h2>Livros Cadastrados</h2>

        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>

                <?php while ($linha = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?= $linha['id'] ?></td>
                        <td><?= $linha['titulo'] ?></td>
                        <td><?= $linha['autor'] ?></td>
                        <td><?= $linha['ano'] ?></td>

                        <td>
                            <form action="delete_book.php" method="POST" style="display:inline;" onsubmit="return confirmar(<?= $linha['id'] ?>)">
                                <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                                <button class="deleteBook">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </table>

        <?php else: ?>
            <p style="text-align:center;">Nenhum livro foi cadastrado.</p>
        <?php endif; ?>

    </div>

    <script>
        function confirmar(id) {
            return confirm("Tem certeza que deseja excluir o livro de número " + id + "?");
        }

        document.getElementById("formAdd").onsubmit = function() {
            var titulo = this.titulo.value;
            var autor = this.autor.value;
            var ano = this.ano.value;

            if (titulo == "" || titulo.length < 2) {
                alert("Inválido");
                return false;
            }

            if (autor == "" || autor.length < 2) {
                alert("Inválido");
                return false;
            }

            if (ano == "" || ano <= 0) {
                alert("Inválido");
                return false;
            }
            return true;
        }
    </script>

</body>

</html>