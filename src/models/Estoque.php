<?php
// filepath: c:\xampp\htdocs\meu-projeto-estoque\src\models\Estoque.php

class Estoque {
    private $itens = [];

    // Adiciona um item ao estoque
    public function adicionar($codigoBarras, $nome, $cidade, $quantidade) {
        if ($quantidade > 0) {
            $this->itens[] = [
                'codigoBarras' => $codigoBarras,
                'nome' => $nome,
                'cidade' => $cidade,
                'quantidade' => $quantidade
            ];
        } else {
            throw new InvalidArgumentException("A quantidade deve ser um número positivo.");
        }
    }

    // Adiciona múltiplos itens ao estoque
    public function adicionarEmMassa($produtos) {
        foreach ($produtos as $produto) {
            $this->adicionar($produto['codigoBarras'], $produto['nome'], $produto['cidade'], $produto['quantidade']);
        }
    }

    // Remove um item do estoque pelo ID
    public function remover($id) {
        if (isset($this->itens[$id])) {
            unset($this->itens[$id]);
        } else {
            throw new OutOfBoundsException("ID inválido.");
        }
    }

    // Edita um item do estoque pelo ID
    public function editar($id, $codigoBarras, $nome, $cidade, $quantidade) {
        if (isset($this->itens[$id])) {
            $this->itens[$id] = [
                'codigoBarras' => $codigoBarras,
                'nome' => $nome,
                'cidade' => $cidade,
                'quantidade' => $quantidade
            ];
        } else {
            throw new OutOfBoundsException("ID inválido.");
        }
    }

    // Lista todos os itens do estoque
    public function listar() {
        return $this->itens;
    }
}