<?php
    session_start();

    require_once 'Controller/UsuarioController.php';
    require_once 'Controller/ImovelController.php';
    require_once 'Header.php';

    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true)
    {
        require_once 'view/menu.php';
    
        if (isset($_GET['page']))
        {
            if ($_GET['page'] == "usuario")
            {
                if (isset($_GET['action']))
                {
                    if ($_GET['action'] == 'editar')
                    {
                        $usuario = call_user_func(array('UsuarioController', 'editar'), $_GET['id']);
                        require_once 'view/CadUsuario.php';
                    }

                    if ($_GET['action'] == 'excluir')
                    {
                        $usuario = call_user_func(array('UsuarioController', 'excluir'), $_GET['id']);
                        require_once 'view/ListUsuario.php';
                    }

                    if ($_GET['action'] == 'cadastrar')
                    {
                        require_once 'view/CadUsuario.php';
                    }                

                    if ($_GET['action'] == 'listar')
                    {
                        $usuario = call_user_func(array('UsuarioController', 'listar'));
                        require_once 'view/ListUsuario.php';
                    }
                }            
                else
                {
                    require_once 'view/CadUsuario.php';
                }            
            }

            if ($_GET['page'] == "imovel")
            {
                if (isset($_GET['action']))
                {
                    if ($_GET['action'] == 'editar')
                    {
                        $imovel = call_user_func(array('ImovelController', 'editar'), $_GET['id']);
                        require_once 'view/CadImovel.php';
                    }

                    if ($_GET['action'] == 'excluir')
                    {
                        $imovel = call_user_func(array('ImovelController', 'excluir'), $_GET['id']);
                        require_once 'view/ListImobiliaria.php';
                    }

                    if ($_GET['action'] == 'cadastrar')
                    {
                        require_once 'view/CadImovel.php';
                    }

                    if ($_GET['action'] == 'listar')
                    {
                        require_once 'view/ListImobiliaria.php';
                    }
                }
                else
                {
                    require_once 'view/CadImovel.php';
                }
            }

        }
    }
    else
    {
        if (isset($_GET['logar']))
        {
            require_once 'view/login.php';
        }
        else
        {
            require_once 'principal.php';
        }
    }
?>
