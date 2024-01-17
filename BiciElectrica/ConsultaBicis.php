// Programa principal
<?php

include "BiciElectrica.php";
//Funciones a implementar

// Método para cargar bicicletas desde un archivo CSV
function cargabicis()
{
    //  1º Leer un fichero linea a linea
    define ('FICHERO','Bicis.csv');

    $frecurso = @fopen(FICHERO,'r'); // OJO sin arroba Si hay fallo muestra avisos
    if ( ! $frecurso ){
        die(" Fallo al abrir el fichero");
    }

    // Inicializar la lista de bicicletas
    $bicicletas = [];

    // Procesar los datos de las bicicletas
    while ( $linea = fgets($frecurso)) {
        $datos = explode(',', $linea);
        // Verificar si la línea tiene la cantidad esperada de elementos
        if (count($datos) == 5) {
            // Crear una nueva instancia de BiciElectrica y agregarla a la lista
            $bici = new BiciElectrica($datos[0], $datos[1], $datos[2], $datos[3], $datos[4]);
            $bicicletas[] = $bici;
        } else {
            // Manejar el error si la línea no tiene la cantidad esperada de elementos
            throw new Exception("Error en el formato de la línea en el archivo CSV.");
        }
    }
    fclose($frecurso);

    // Devolver la lista de bicicletas
    return $bicicletas;
}

function mostrartablabicis($tabla):string
{
    $msg = "";

    $msg .= "<table>";
        foreach ($tabla as $bici) 
        {
            if($bici->operativa == 1)
            {
                $msg .= "<tr>";
                $atributosBici = ['id', 'coordx', 'coordy', 'bateria', 'operativa'];


                    foreach ($atributosBici as $valor)
                    {
                        $msg .= "<td>". $bici->$valor. "</td>";
                        
                    }


                $msg .= "</tr>";
            }
            
        }

    $msg .= "</table>";


    return $msg;
}

function bicimascercana($x,$y, $tabla)
{
    $distanciaMinima = PHP_FLOAT_MAX;
    $biciRecomendada = null;
    
    foreach($tabla as $bici)
    {
        $distancia = $bici->distancia($x, $y);

        if($distancia < $distanciaMinima)
        {
            $distanciaMinima = $distancia;
            $biciRecomendada = $bici;
        }
    }

    return $biciRecomendada;
}
?>




<?php
$tabla = cargabicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
$biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>MOSTRAR BICIS OPERATIVAS</title>
<style>
table, th, td {
border: 1px solid black;
}
</style>

</head>

<body>
<h1> Listado de bicicletas operativas </h1>
<?= mostrartablabicis($tabla); ?>
<?php if (isset($biciRecomendada)) : ?>
<h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
<button onclick="history.back()"> Volver </button>
<?php else : ?>
<h2> Indicar su ubicación: <h2>
<form>
Coordenada X: <input type="number" name="coordx"><br>
Coordenada Y: <input type="number" name="coordy"><br>
<input type="submit" value=" Consultar ">
</form>
<?php endif ?>
</body>

</html>
