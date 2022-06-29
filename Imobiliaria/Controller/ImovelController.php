<?php
    require_once 'model/Imovel.php';

    class ImovelController
    {
        public function salvar()
        {
            $imovel = new Imovel();

            $imovel->setTipo($_POST['tipo']);
            $imovel->setPreco($_POST['preco']);
            $imovel->setDescricao($_POST['descricao']);
            $imovel->save();
        }

        public function listar()
        {
            $imovel = new Imovel;
            return $imovel->listAll();
        }

        public function editar($id)
        {
            $imovel = new Imovel();
            $imovel = $imovel->find($id);
            return $imovel;
        }

        public function excluir($id)
        {
            $imovel = new Imovel();
            $imovel = $imovel->remove($id);
        }
    }
?>