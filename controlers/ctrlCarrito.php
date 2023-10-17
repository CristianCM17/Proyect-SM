<?php 
require_once '../models/CarritoModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

    if( isset($_GET['carr']) ){
         $CarritoModel= new PagosModel();

        switch($_GET['carr']){
            case 1: // INSERT TO DB
                $CarritoModel->getAll();
                break;

    }
}else{
    header('Location: ./carrito.php');
}
?>