<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
</head>
<body>
    <h1>Controle de Estoque</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../controllers/EstoqueController.php';
            $estoqueController = new EstoqueController();
            $itens = $estoqueController->listarItens();

            foreach ($itens as $item) {
                echo "<tr>
                        <td>{$item->id}</td>
                        <td>{$item->nome}</td>
                        <td>{$item->quantidade}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>