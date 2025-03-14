<?php
require_once '../src/models/Estoque.php';

$estoque = new Estoque();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'] ?? null;
    $codigoBarras = $_POST['codigoBarras'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $preco = $_POST['preco'] ?? null;
    $visivel = $_POST['visivel'] ?? null;
    $quantidade = $_POST['quantidade'] ?? null;

    try {
        if ($action === 'adicionar') {
            $estoque->adicionar($codigoBarras, $nome, $preco, $visivel, $quantidade);
        } elseif ($action === 'remover') {
            $estoque->remover($id);
        } elseif ($action === 'editar') {
            $estoque->editar($id, $codigoBarras, $nome, $preco, $visivel, $quantidade);
        }
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($estoque->listar());
}