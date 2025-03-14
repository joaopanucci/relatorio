<?php
require_once '../src/models/Estoque.php';
require_once '../lib/fpdf.php';

$estoque = new Estoque();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'gerarRelatorio') {
    $produtos = json_decode($_POST['produtos'], true);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Relatorio de Produtos');
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1);
    $pdf->Cell(40, 10, 'Codigo de Barras', 1);
    $pdf->Cell(40, 10, 'Nome', 1);
    $pdf->Cell(40, 10, 'Cidade', 1);
    $pdf->Cell(20, 10, 'Quantidade', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    foreach ($produtos as $produto) {
        $pdf->Cell(20, 10, $produto['id'], 1);
        $pdf->Cell(40, 10, $produto['codigoBarras'], 1);
        $pdf->Cell(40, 10, $produto['nome'], 1);
        $pdf->Cell(40, 10, $produto['cidade'], 1);
        $pdf->Cell(20, 10, $produto['quantidade'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'relatorio.pdf');
}