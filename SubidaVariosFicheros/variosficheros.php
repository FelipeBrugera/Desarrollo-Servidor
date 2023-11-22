<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesa subir varios ficheros</title>
</head>
<?php
    $destino = "/home/felipe/imgusers/"; // Directorio de destino donde se guardarán los archivos
    $mensaje = "";
    $maxFileSize = 300 * 1024;
    $cont = 0;
    echo "0";

    // No se recibe nada, error al enviar el POST, se supera post_max_size
if (count($_POST) == 0 ){
    $mensaje= "  Error: se supera el tamaño máximo de un petición POST ";
    }
 // si no se reciben el directorio de alojamiento y el archivo, se descarta el proceso
 else if ((! isset($_FILES['archivos']['name'])) ) {
     $mensaje .= 'ERROR: No se indicó el archivo y/o no se indicó el directorio';
 } else
 {
    $total_archivos = count($_FILES['archivos']['name']);
        echo "1";

        for($i=0; $i<$total_archivos; $i++)
        {
            $tamano_archivo = $_FILES['archivos']['size'][$i];

            $cont = $cont + $tamano_archivo;
        }
    
        for($i=0; $i<$total_archivos; $i++)
        {
            $nombre_archivo = $_FILES['archivos']['name'][$i];
            $tipo_archivo = $_FILES['archivos']['type'][$i];
            $tamano_archivo = $_FILES['archivos']['size'][$i];
            $tmp_archivo = $_FILES['archivos']['tmp_name'][$i];
            $error_archivo = $_FILES['archivos']['error'][$i];

    
            // Verificar si se ha producido algún error al recibir el archivo
            if($error_archivo === 0)
            {
                if ($cont <=$maxFileSize)
                {
                    
                    // Verificar el tamaño del archivo
                    if($tamano_archivo <= 200 * 1024)
                    {
                        // Verificar el formato del archivo (por ejemplo, solo aceptar archivos PNG)
                        if(($tipo_archivo === 'image/png' or $tipo_archivo === 'image/jpeg') and !file_exists($destino.$nombre_archivo))
                        {
                            // Mover el archivo al directorio de destino
                            move_uploaded_file($tmp_archivo, $destino.$nombre_archivo);
                            $mensaje = "El archivo $nombre_archivo se ha subido correctamente.<br>";
                        } 
                        else 
                        {
                            $mensaje = "Error: Solo se permiten archivos PNG o JPG.<br>";
                        }
                    } 
                    else 
                    {
                        $mensaje = "Error: El tamaño del archivo $nombre_archivo es demasiado grande.<br>";
                    }
                }
                elseif($total_archivos == 1)
                {
                    $mensaje = "Error: El tamaño del archivo $nombre_archivo es demasiado grande.<br>";
                }
                else
                {
                    $mensaje = "Error: El tamaños de los archivos en conjunto es demasiado grande.<br>";
                }
            } 
            else 
            {
                $mensaje = "Error: No se ha recibido ningun archivo. Código de error: $error_archivo.<br>";
            }
        }
 }

        
   
?>
<body>
    <?php echo " Bienvenido "."<br>"?>
    <?php echo $mensaje; ?>
    <br />
        <a href="FormVariosFicheros.html">Volver a la página de subida</a>
</body>
</html>