<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';

define('TIEMPOVALIDEZ', time() + 24 * 60 * 60);


if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = false;
    $_SESSION['tiempo'] = time();
}

if ($_SESSION['login'] == true) {
    if (time() - $_SESSION['tiempo'] > 300) {
        session_destroy();
        header("Location: index.php");
    }
    // Div con contenido
    $contenido = "";
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if (isset($_GET['orden'])) {
            switch ($_GET['orden']) {
                case "Nuevo":
                    accionAlta();
                    break;
                case "Borrar":
                    accionBorrar($_GET['id']);
                    break;
                case "Modificar":
                    accionModificar($_GET['id']);
                    break;
                case "Detalles":
                    accionDetalles($_GET['id']);
                    break;
                case "Terminar":
                    accionTerminar();
                    break;
                case "IncrementarSaldo":
                    if (empty($_GET['check'])) {
                        $array = [];
                        accionIncrementarSaldo($array);
                    } else {
                        accionIncrementarSaldo($_GET['check']);
                    }
                    break;
                case "Bloqueo":
                    if (empty($_GET['check'])) {
                        $array = [];
                        accionBloqueo($array);
                    } else {
                        accionBloqueo($_GET['check']);
                    }
                    break;
            }
        }
    }
    // POST Formulario de alta o de modificación
    else {
        if (isset($_POST['orden'])) {
            switch ($_POST['orden']) {
                case "Nuevo":
                    accionPostAlta();
                    break;
                case "Modificar":
                    accionPostModificar();
                    break;
                case "Detalles":; // No hago nada
            }
        }
    }
    $contenido .= mostrarDatos();
    // Muestro la página principal
    include_once "app/layout/principal.php";
} else {
    include_once "app/layout/login.php";

    if(!isset($_COOKIE["intentos"]))
    {
        setcookie("intentos", 3, TIEMPOVALIDEZ);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['pin'] == "hola1234" && $_COOKIE["intentos"] > 0) {
            $_SESSION['login'] = true;
            header("Location: index.php");
        }
        else{
            if(isset($_COOKIE["intentos"]) && $_COOKIE["intentos"] >0)
            {
                $varCookie = $_COOKIE["intentos"];

                setcookie("intentos", $varCookie-1, TIEMPOVALIDEZ);
            }
            if($_COOKIE["intentos"] == 0){
                echo '<script>alert("Contraseña incorrecta: Ya has agotado los 3 intentos.");</script>';
            }
        }
    }
}
