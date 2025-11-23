<?php
require "database.php";

$pendentes = mysqli_query($conexao, "SELECT * FROM tarefas WHERE concluida = 0 ORDER BY vencimento ASC");
$concluidas = mysqli_query($conexao, "SELECT * FROM tarefas WHERE concluida = 1 ORDER BY vencimento ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Questão 2 - Gerenciador de Tarefas</title>
    <style>
        body {
            background: #bd00fe;
            margin: 0;
            padding: 20px;
        }

        .corpo {
            max-width: 800px;
            margin: auto;
            background: whitesmoke;
            padding: 20px;
            border-radius: 9px;
        }

        h1 {
            background: #7b1fa2;
            color: white;
            padding: 18px;
            text-align: center;
            margin: 0 25px;
            border-radius: 6px;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            margin-top: 30px;
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
            padding: 9px;
            text-align: left;
            background: #eee;
        }

        td {
            padding: 9px;
            text-align: left;
            background: #eee;
        }

        .conclude {
            background: #5cb85f;
            color: black;
            border: none;
        }

        .conclude:hover {
            opacity: 0.8;
        }

        .delete {
            background: #c9302e;
            color: black;
            border: none;
        }

        .delete:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="corpo">
        <h1>Gerenciador de Tarefas</h1>

        <h2>Adicionar Nova Tarefa</h2>
        <form action="add_tarefa.php" method="POST" id="formAdd">
            <input type="text" name="descricao" placeholder="Adicione aqui a tarefa" required>
            <input type="date" name="vencimento" required>
            <br>
            <button>Adicionar</button>
        </form>

        <h2>Tarefas Pendentes</h2>
        <?php
        $temPendentes = false;
        echo "<table><tr><th>ID</th><th>Descrição</th><th>Vencimento</th><th>Marcações</th></tr>";
        while ($linha = mysqli_fetch_assoc($pendentes)):
            $temPendentes = true;
        ?>
            <tr>
                <td><?= $linha['id'] ?></td>
                <td><?= $linha['descricao'] ?></td>
                <td><?= $linha['vencimento'] ?></td>
                <td>
                    <form action="update_tarefa.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                        <button class="conclude">Concluir</button>
                    </form>
                    <form action="delete_tarefa.php" method="POST" style="display:inline;" onsubmit="return confirmar(<?= $linha['id'] ?>)">
                        <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                        <button class="delete">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile;
        echo "</table>";
        if (!$temPendentes) echo "<p style='text-align:center;'>Nenhuma tarefa pendente.</p>";
        ?>

        <h2>Tarefas Concluídas</h2>
        <?php
        $temConcluidas = false;
        echo "<table><tr><th>ID</th><th>Descrição</th><th>Vencimento</th><th>Marcações</th></tr>";
        while ($linha = mysqli_fetch_assoc($concluidas)):
            $temConcluidas = true;
        ?>
            <tr>
                <td><?= $linha['id'] ?></td>
                <td><s><?= $linha['descricao'] ?></s></td>
                <td><?= $linha['vencimento'] ?></td>
                <td>
                    <form action="delete_tarefa.php" method="POST" style="display:inline;" onsubmit="return confirmar(<?= $linha['id'] ?>)">
                        <input type="hidden" name="id" value="<?= $linha['id'] ?>">
                        <button class="delete">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile;
        echo "</table>";
        if (!$temConcluidas) echo "<p style='text-align:center;'>Nenhuma tarefa concluída.</p>";
        ?>
    </div>

    <script>
        function confirmar(id) {
            return confirm("Tem certeza que deseja excluir esta tarefa?");
        }

        document.getElementById("formAdd").onsubmit = function() {
            var descricao = this.descricao.value;
            var data = this.vencimento.value;

            if (descricao == "" || descricao.length < 2) {
                alert("Inválido");
                return false;
            }

            if (data == "") {
                alert("Selecione uma data de vencimento");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>