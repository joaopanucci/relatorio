<?php
require_once '../src/models/Estoque.php';

$estoque = new Estoque();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['csvFile'])) {
        $file = $_FILES['csvFile']['tmp_name'];

        if (($handle = fopen($file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                list($codigoBarras, $nome, $cidade, $quantidade) = $data;
                try {
                    $estoque->adicionar($codigoBarras, $nome, $cidade, $quantidade);
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                    exit();
                }
            }
            fclose($handle);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao abrir o arquivo.']);
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'adicionarEmMassa') {
        $produtos = json_decode($_POST['produtos'], true);
        try {
            $estoque->adicionarEmMassa($produtos);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Nenhum arquivo enviado.']);
    }
}