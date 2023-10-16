<?php

    define ('dado1', '&#9856;');
    define ('dado2', '&#9857');
    define ('dado3', '&#9858;');
    define ('dado4', '&#9859;');
    define ('dado5', '&#9860;');
    define ('dado6', '&#9861;');

    $dados = [dado1, dado2, dado3, dado4, dado5, dado6];

    $aleatorio;

    function generarDados($dados,$jugador, $emoji)
    {
        $cont=0;
        $mayor=0;
        $menor=6;
        $resto=0;
        echo '<span class="Jugador">' . $jugador . '</span>';

        for($i=0; $i < 6; $i++)
        {
            $aleatorio = rand(0,5);
            $cont += $aleatorio+1;
            $comparar = $aleatorio +1;

            if($mayor < $comparar)
                $mayor = $comparar;
            if($menor > $comparar)
                $menor = $comparar;

            

            if($i != 5)
                echo '<span class="' . $emoji . '">' . $dados[$aleatorio] . '</span>';
            else
            {
                $resto = $mayor + $menor;
                echo '<span class="' . $emoji . '">' . $dados[$aleatorio] . " " . $cont - $resto . " Puntos" . '</span><br>';
            }
                
        }

        return $cont - $resto;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinco dados</title>
    <style>
        .Emoji1{
            font-size: 100px;
            background-color: red;
        }
        .Emoji2{
            font-size: 100px;
            background-color: blue;
        }
        .Jugador{
            font-size: 25px;
        }
    </style>
</head>
<body>

<h1>Cinco dados</h1>

<?php $primerJugador = generarDados($dados,"Jugador 1", 'Emoji1'); ?>
<?php $segunJugador = generarDados($dados,"Jugador 2", 'Emoji2'); ?>
<span class="Jugador">
    <b>Resultado</b>
    <?php 

        if($primerJugador > $segunJugador)
            echo "Ha ganado el Jugador 1";
        else if($primerJugador == $segunJugador)
            echo "Ha habido un empate";
        else
            echo "Ha ganado el Jugador 2";
    ?>
</span>


    
</body>
</html>