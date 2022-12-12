<?php
session_start();
if (empty($_SESSION['mail'])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: ../login.php");
    # Y salimos del script
    exit();
}



?>