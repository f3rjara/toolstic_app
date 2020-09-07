<?php
    session_start();
    if(isset($_SESSION['btnPresentaPrueba']) && $_SESSION['btnPresentaPrueba'] == TRUE ) {
        echo "<br> hola guapuritas la variable es true y esta habilitado a presentar la prueba ";
        if(isset($_SESSION['UserInteraction']) && $_SESSION['UserInteraction'] === TRUE) {
            echo "<br> El usuario SI interactuo";
        }
        else {
            echo "<br> El usuario pailaaaaa REDIRECCINN ";
        }
    }
    else {
        echo "<br> La variable es FALSE y  NO esta habilitado  REDIRECCION";
    }

?>