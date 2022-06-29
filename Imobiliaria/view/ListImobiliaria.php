<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imóvel</title>
</head>
<body>
    <h1 class="listHeader">Imóveis</h1>
    <hr/>
    <div>
        <table style="top:400px;">
            <thead>
                <tr>
                    <th class="header">Login</th>
                    <th class="header">Permissão</th>
                    <th><a href="index.php?page=imovel&action=cadastrar">Novo</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    # require_once '../Controller/ImovelController.php';

                    # Chama a função PHP que permite informar a classe e o método que será acionado
                    $regImovel = call_user_func(array('ImovelController', 'listar'));

                    if (isset($regImovel) && !empty($regImovel))
                    {
                        foreach($regImovel as $imovel)
                        {
                            ?>
                            <tr>
                                <td><?php echo $imovel->getTipo(); ?></td>
                                <td><?php echo $imovel->getPreco(); ?></td>
                                <td>
                                    <a href="index.php?page=imobiliaria&action=editar&id=<?php echo $imovel->getIdImovel(); ?>">Editar</a>
                                    <a href="index.php?page=imobiliaria&action=excluir&id=<?php echo $imovel->getIdImovel(); ?>">Excluir</a>
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