<?php

session_start();

//si se dio click al boton de carrito y no hay una session login me manda al login
    if (isset($_POST['ircarrito']) && !isset($_SESSION['login'])) {
        header("Location: ../vistas/login.php");
    }else  header("Location: ../vistas/carrito.php");;



?>