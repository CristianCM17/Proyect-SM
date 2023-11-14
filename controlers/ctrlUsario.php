<?php
require_once '../models/UsuarioModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

session_start();



if (isset($_GET['action'])){
    $usuario=new UsuarioModel;
    $secret ="6LdLcAgpAAAAAFZwxYUkr47-gW8G6zTlpW3S6QLp";
    $response= $_POST['g-recaptcha-response'];
    $remoteip=$_SERVER['REMOTE_ADDR'];
    $url= "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $row=json_decode($data, true);

    switch ($_GET['action']) {
        case 1:
            $nombre=filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_SPECIAL_CHARS);//$_POST['nombre'];
            $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);//$_POST['email'];
            $contrasena=filter_input(INPUT_POST,'contrasena',FILTER_SANITIZE_EMAIL);//$_POST['contrasena'];
            $latitud=filter_input(INPUT_POST,'latitud',FILTER_SANITIZE_NUMBER_INT);//$_POST['latitud'];
            $longitud=filter_input(INPUT_POST,'longitud',FILTER_SANITIZE_NUMBER_INT);//$_POST['longitud'];

           
            
        if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['contrasena']) || empty($_POST['latitud']) || empty($_POST['longitud'])) {
            //echo "Por favor llene todos los campos"."\n";
            header("Location: ../vistas/signup.php?err=1");
            if ($row['success'] == "false") {
                //echo "Yo creo que eres un robot, confirmalo";
                header("Location: ../vistas/signup.php?err=1");
               }
        }  else {
            //si el correo es igual me manda error, si no, me inserta
            if ($usuario->validarEmail($email)) {
                header("Location: ../vistas/signup.php?err=2");
                }else {
                    $hashContr= password_hash($email,PASSWORD_DEFAULT); //encriptar contrasena
                    $usuario->insertar($nombre,$email,$hashContr,$latitud,$longitud);
                    $_SESSION['login']= $email;
                    $usuario->insertarUsRol($email);
                    header("Location: ../vistas/carrito.php");
                    }
            }
            break;
        
    } 
}



        

  




?>