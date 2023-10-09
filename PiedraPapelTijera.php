<?php
        $jueguito=[[0,2,1],
                   [1,0,2],
                   [2,1,0]];
        
        define ('PIEDRA1',  "&#x1F91C;");
        define ('PIEDRA2',  "&#x1F91B;");
        define ('TIJERAS',  "&#x1F596;");
        define ('PAPEL',    "&#x1F91A;" );  
        
        $jugadorUno = rand(0,2);
        $jugadorDos = rand(0,2);

        function Ganador($jugadorUno, $jugadorDos,$jueguito)
        {
           return $jueguito[$jugadorUno][$jugadorDos] ;
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .Emoji{
            font-size: 100px;
        }
    </style>
</head>
<body>

    <div>
        <h1>¡Piedra, papel, tijera!</h1>
        <p>Actualice la página para mostrar otra partida</p>
        <span><b>Jugador 1</b></span>  &nbsp; <span><b>Jugador 2</b></span><br>
        <?php
            switch($jugadorUno)
            {
                case 0:
                    echo '<span class="Emoji">' . PIEDRA1 . '</span>';
                    break;
                case 1:
                    echo '<span class="Emoji">' . PAPEL . '</span>';
                    break;
                case 2: 
                    echo '<span class="Emoji">' . TIJERAS . '</span>';
                    break;
                    
            }

            switch($jugadorDos)
            {
                case 0:
                    echo '<span class="Emoji">' . PIEDRA2 . '</span><br>';
                    break;
                case 1:
                    echo '<span class="Emoji">' .  PAPEL . '</span><br>';
                    break;
                case 2: 
                    echo '<span class="Emoji">' . TIJERAS . '</span><br>';
                    break;
                    
            }

            $ganador = Ganador($jugadorUno, $jugadorDos, $jueguito);

            switch($ganador)
            {
                case 0:
                    echo "¡Empate!";
                    break;
                case 1: 
                    echo "¡Ha ganado el Jugador 1!";
                    break;
                case 2:
                    echo "¡Ha ganado el Jugador 2!";
                    break;
            }
        ?>

    </div>
    

   
</body>
</html>