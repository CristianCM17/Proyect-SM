<?php
require_once '../models/UsuarioModel.php';
require_once '../models/VentaModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';
session_start();

if (isset($_GET['pro'])){
    $usuarioModel= new UsuarioModel;
    $ventaModel= new VentaModel;

    $idUsuario= $usuarioModel->buscarId($_SESSION['login']['email']);
    $total= $_SESSION['total'];
    
    switch ($_GET['pro']) {
        case 1:
            $ventaModel->insertarVenta($idUsuario,$total);
            
            break;
        
        case 2:
           $ventaModel->completarVenta();
           unset($_SESSION['carrito']);
            break;
    }

}

?>