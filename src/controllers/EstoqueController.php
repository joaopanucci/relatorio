<?php

class EstoqueController {
    private $estoqueModel;

    public function __construct() {
        $this->estoqueModel = new Estoque();
    }

    public function adicionarItem($nome, $quantidade) {
        $this->estoqueModel->adicionar($nome, $quantidade);
    }

    public function removerItem($id) {
        $this->estoqueModel->remover($id);
    }

    public function listarItens() {
        return $this->estoqueModel->listar();
    }
}