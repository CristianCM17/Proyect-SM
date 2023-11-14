<?php
require_once '../models/UsuarioModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

session_start();

    if ($_GET['log']) {
        $usuario= new UsuarioModel();
        if ($_GET['log']==1) {
            $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
            $contrasena=filter_input(INPUT_POST,'contrasena',FILTER_SANITIZE_SPECIAL_CHARS);
        
            if (empty($email) || empty($contrasena)) {
              echo "Email o contraseña incorrectos 1";
            }else {
                if ($usuario->validarLogin($email,$contrasena)) {
                    $_SESSION['login']= $email;
                    echo true;
                }  else {
                    echo "Email o contraseña incorrectos 2";
                }

            }
        }
    }
   


?>