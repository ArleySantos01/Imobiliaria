<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de usuário</title>
    <link rel="stylesheet" href="view/css/estilos.css" />
</head>
<body>
    <form name="cadUsuario" id="cadUsuario" action="" method="post">
        <label>Login</label><br/>
        <input type="text" name="login" id="login" value="<?php echo isset($usuario)?$usuario->getLogin():''; ?>"/><br/><br/>
        <input type="hidden" name="id" id="id" value="<?php echo isset($usuario)?$usuario->getId():''; ?>" />
        <label>Senha</label><br/>
        <input type="password" name="senha1" id="senha1" value="<?php echo isset($usuario)?$usuario->getSenha():''; ?>" /><br/><br/>
        <label>Confirmação de senha</label><br/>
        <input type="password" name="senha2" id="senha2" /><br/><br/>
        <label>Tipo de usuário</label><br/>
        <select name="permissao" id="permissao">
            <option value="0"></option>
            <option value="A" <?php echo isset($usuario) && $usuario->getPermissao()=='A'?'selected':''; ?>>Administrador</option>
            <option value="C" <?php echo isset($usuario) && $usuario->getPermissao()=='C'?'selected':''; ?>>Comum</option>
        </select><br/><br/>
        <input type="hidden" name="id" id="id" value="<?php echo isset($usuario)?$usuario->getId():''; ?>" />
        <input type="submit" name="btnSalvar" id="btnSalvar" />   
    </form>
</body>
</html>

<?php
    # Verifica se o botão submit foi acionado
    if (isset($_POST['btnSalvar']))
    {
        # Importa o UsuarioController.php
        #require_once 'Controller/UsuarioController.php';

        # Chama uma função PHP que permite informar a classe e o método que será acionado 
        call_user_func(array('UsuarioController', 'salvar'));
        header('Location:index.php?page=usuario&action=listar');
    }
?>