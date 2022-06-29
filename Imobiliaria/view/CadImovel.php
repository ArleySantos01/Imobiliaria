<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de imóvel</title>
    <link rel="stylesheet" href="view/css/estilos.css" />
</head>
<body>
    <form name="cadImovel" id="cadImovel" action="" method="post">
        <label>Tipo de imóvel</label><br/>
        <select name="tipo" id="tipo">
            <option value="0"></option>
            <option value="A">Apartamento</option>
            <option value="B">Kitnet</option>
            <option value="C">Flat</option>
        </select><br/><br/>
        <label>Preço</label><br/>
        <input type="text" name="preco" id="preco" /><br/>
        <label>Descrição</label><br/>
        <input type="text" name="descricao" id="descricao" /><br/><br/>
        <input type="submit" name="btnSalvar" id="btnSalvar" />
    </form>
</body>
</html>

<?php
    # Verifica se o botão submit foi acionado
    if (isset($_POST['btnSalvar']))
    {
        # Chama uma função PHP que permite informar a classe e o método que será acionado 
        call_user_func(array('ImovelController', 'salvar'));
        header('Location:index.php?page=imovel&action=listar');
    }
?>