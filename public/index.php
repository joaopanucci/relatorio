<?php
// filepath: c:\xampp\htdocs\meu-projeto-estoque\public\index.php
require_once '../src/controllers/EstoqueController.php';
require_once '../src/models/Estoque.php';
$controller = new EstoqueController();
$controller->adicionarItem('Item 1', 10);
$controller->adicionarItem('Item 2', 5);

$itens = $controller->listarItens();
foreach ($itens as $id => $item) {
    echo "ID: $id, Nome: {$item['nome']}, Quantidade: {$item['quantidade']}<br>";
}

// Redireciona para o arquivo HTML
header('Location: index.html');
exit();