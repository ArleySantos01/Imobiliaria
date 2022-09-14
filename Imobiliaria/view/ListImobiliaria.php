<?php
    if (isset($_GET['tipo']))
    {
        $imoveis = call_user_func(array('ImovelController', 'listarTipo'), $_GET['tipo']);
    }
    else
    {
        $imoveis = call_user_func(array('ImovelController', 'listar'));
    }
?>

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
                    $cont = 0;

                    if (isset($regImovel) && !empty($regImovel))
                    {
                        foreach($regImovel as $imovel)
                        {
                            if ($cont == 0)
                            {
                                echo '<tr>';
                            }

                            echo '<td>';
                            echo '<p align="center"><img style="width: 25%" src="data:'.$imovel->getFotoTipo().';base64,'.base64_encode($imovel->getFoto()).'"></p><br>';;
                            echo substr($imovel->getDescricao(), 0,70).'...<br>';
                            echo '<strong>Valor: </strong>'.$imovel->getPreco().'<br>';
                            $tipo = $imovel->getTipo() == 'A' ? 'Aluguel' : 'Venda';
                            echo '<strong>Tipo: </strong>'.$tipo.'<br>';
                            echo '<a href="index.php?action=editar&id='.$imovel->getIdImovel().'&page=imovel">Editar</a>&nbsp;&nbsp;&nbsp;';
                            echo '<a href="index.php?action=excluir&id='.$imovel->getIdImovel().'&page=imovel">Excluir</a>';
                            echo '<a href="index.php?action=excluir&id='.$imovel->getIdImovel().'&page=imovel">Galeria</a>';    # TO-DO: adicionar a funcionalidade da galeria
                            $cont++;
                            if ($cont == 4)
                            {
                                $cont = 0;
                            }
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