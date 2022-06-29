<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuários</title>
</head>
<body>
    <h1 class="listHeader">Usuários</h1>
    <hr/>
    <div>
        <table style="top:400px;">
            <thead>
                <tr>
                    <th class="header">Login</th>
                    <th class="header">Permissão</th>
                    <th><a href="index.php?page=usuario&action=cadastrar">Novo</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    # require_once 'Controller/UsuarioController.php';

                    # Chama a função PHP que permite informar a classe e o método que será acionado
                    $usuarios = call_user_func(array('UsuarioController', 'listar'));

                    # Verifica se houve algum retorno
                    if (isset($usuarios) && !empty($usuarios))
                    {
                        foreach ($usuarios as $usuario)
                        {
                            ?>
                            <tr>
                                <td><?php echo $usuario->getLogin(); ?></td>
                                <td><?php echo $usuario->getPermissao(); ?></td>
                                <td>
                                    <a href="index.php?page=usuario&action=editar&id=<?php echo $usuario->getId();?>">Editar</a>
                                    <a href="index.php?page=usuario&action=excluir&id=<?php echo $usuario->getId();?>">Excluir</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="5">Nenhum registro encontrado</td>
                        </tr>
                        <?php
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>