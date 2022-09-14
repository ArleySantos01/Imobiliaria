<?php
    require_once 'model/Imovel.php';

    class ImovelController
    {
        public static function salvar($fotoAtual="", $fotoTipo="")
        {
            $imovel = new Imovel();

            $imagem = array();
            if (is_uploaded_file($_FILES['foto']['tmp_name']))
            {
                $imagem['data'] = file_get_contents($_FILES['foto']['tmp_name']);
                $imagem['tipo'] = $_FILES['foto']['type']; // ['tipo']
            }

            if (!empty($imagem))
            {
                $imovel->setFoto($imagem['data']);
                $imovel->setFotoTipo($imagem['tipo']);
            }
            else
            {
                $imovel->setFoto($fotoAtual);
                $imovel->setFotoTipo($fotoTipo);
            }
            # $imovel->setId($_POST['id']);
            $imovel->setTipo($_POST['tipo']);
            $imovel->setPreco($_POST['preco']);
            $imovel->setDescricao($_POST['descricao']);
            $imovel->save();
            # print_r($imovel);
        }

        public static function listar()
        {
            $imovel = new Imovel;
            return $imovel->listAll();
        }

        public static function editar($id)
        {
            $imovel = new Imovel();
            $imovel = $imovel->find($id);
            return $imovel;
        }

        public static function excluir($id)
        {
            $imovel = new Imovel();
            $imovel = $imovel->remove($id);
        }
    }
?>