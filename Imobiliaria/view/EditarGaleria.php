<?php
    $galeria = call_user_func(array('GaleriaController', 'listar'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
</head>
<body>
    <h1 class="listHeader">Galeria</h1>    
    <hr/>
    <div>
        <table style="width:400px;">
            <thead>
                <th class="header">Sua galeria</th>
                <th><a href="index.php?page=galeria&action=listar">Alterar / adicionar</a></th>
            </thead>
            <tbody>
                <?php
                    $regGaleria = call_user_func(array('GaleriaController', 'listar'));
                    $cont = 0;

                    if (isset($regGaleria) && !empty($regGaleria))
                    {
                        foreach($regGaleria as $galeria)
                        {
                            if ($cont == 0)
                            {
                                echo '<tr>';
                            }

                            echo '<td>';
                            echo '<p align="center"><img style="width: 25%" src="data:'.$galeria->getFotoTipo().';base64,'.base64_encode($galeria->getFoto()).'"></p><br>';
                            echo substr($galeria->getDescricao(), 0,70).'...<br>';
                            echo '<strong>Valor: </strong>'.$galeria->getPreco().'<br>';
                            $tipo = $galeria->getTipo() == 'A' ? 'Aluguel' : 'Venda';
                            echo '<strong>Tipo: </strong>'.$tipo.'<br>';
                            echo '<a href="index.php?action=editar&id='.$galeria->getIdGaleria().'&page=imovel">Editar</a>&nbsp;&nbsp;&nbsp;';
                            echo '<a href="index.php?action=excluir&id='.$galeria->getIdGaleria().'&page=imovel">Excluir</a>';
                            echo '<a href="index.php?action=galeria&id='.$galeria->getIdGaleria().'&page=imovel">Galeria</a>';    # TO-DO: adicionar a funcionalidade da galeria
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
                            <td colspan="5">Nenhuma foto registrada</td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>