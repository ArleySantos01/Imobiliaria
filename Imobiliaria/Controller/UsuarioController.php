<?php
    require_once 'model/Usuario.php';

    class UsuarioController
    {
        # Salvar o usuário submetido pelo formulário
        # public static function - Em caso de futuros problemas
        public static function salvar()
        {
            $usuario = new Usuario();

            # Armazena as informações do $_POST via set
            $usuario->setId($_POST['id']);
            $usuario->setLogin($_POST['login']);
            $usuario->setSenha($_POST['senha1']);
            $usuario->setPermissao($_POST['permissao']);

            # Chama o método save para gravar as informações no banco de dados
            $usuario->save();
        }

        # Lista os usuários
        public static function listar()
        {
            $usuario = new Usuario;        # Objeto para o usuário
            return $usuario->listAll();    # Chama o método listAll()
        }

        # Mostrar formulário para editar um usuário
        public static function editar($id)
        {
            $usuario = new Usuario();
            $usuario = $usuario->find($id);
            return $usuario;
        }

        # Logar com um usuário no sistema
        public static function logar()
        {
            $usuario = new Usuario();
            $usuario->setLogin($_POST['login']);
            $usuario->setSenha($_POST['senha']);
            return $usuario->logar();
        }

        # Apaga um usuário conforme o id informado
        public static function excluir($id)
        {
            $usuario = new Usuario;
            $usuario = $usuario->remove($id);
        }
    }
?>