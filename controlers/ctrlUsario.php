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
            $nombre=$_POST['nombre'];
            $email=$_POST['email'];
            $contrasena=$_POST['contrasena'];
            $latitud=$_POST['latitud'];
            $longitud=$_POST['longitud'];

            
        if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['contrasena']) || empty($_POST['latitud']) || empty($_POST['longitud'])) {
            echo "Por favor llene todos los campos"."\n";
            if ($row['success'] == "false") {
                echo "Yo creo que eres un robot, confirmalo";
               }
        }  else {
            $usuario->insertar($nombre,$email,$contrasena,$latitud,$longitud);
            $_SESSION['login']= $email;
            header("Location: ../vistas/carrito.php");
            }
            break;
        
    } 
}



        

  




?>