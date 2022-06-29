<?php
    require_once 'model/Usuario.php';

    class UsuarioController
    {
        # Salvar o usuário submetido pelo formulário
        # public static function - Em caso de futuros problemas
        public function salvar()
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
        public function listar()
        {
            $usuario = new Usuario;        # Objeto para o usuário
            return $usuario->listAll();    # Chama o método listAll()
        }

        # Mostrar formulário para editar um usuário
        public function editar($id)
        {
            $usuario = new Usuario();
            $usuario = $usuario->find($id);
            return $usuario;
        }

        # Apaga um usuário conforme o id informado
        public function excluir($id)
        {
            $usuario = new Usuario;
            $usuario = $usuario->remove($id);
        }
    }
?>