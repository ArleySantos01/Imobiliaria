<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página login</title>
</head>
<body>
    <div>
        <form name="cadLogin" id="cadLogin" action="" method="post">
            <div>
                <label for="cadLogin">Login</label>
            <div>
                <label for="cadLogin">Usuário: </label>
                <input type="text" name="login" id="login" value="" />
            </div>
            <div>
                <label for="cadLogin">Senha: </label>
                <input type="password" name="senha" id="senha" value="" />
            </div>
            <div>
                <input type="submit" name="btnLogar" id="btnLogar" value="Logar" />
            </div>
        </form>
    </div>
</body>
</html>

<?php
    if (isset($_POST['btnLogar']))
    {
        # Armazena o usuário na SESSION
        $_SESSION['logado'] = call_user_func(array('UsuarioController', 'logar'));
        $_SESSION['login'] = $_POST['login'];

        # Redirecion para a index
        header('Location: index.php');
    }
?>