<?php 
require_once '../models/CarritoModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

    if( isset($_GET['carr']) ){
         $CarritoModel= new CarritoModel();

        switch($_GET['carr']){
            case 1: // mostrar
                $CarritoModel->getAll();
                break;
            case 2: 
                $idcarro= $_POST['idcarro'];
                $CarritoModel->delete($idcarro);
                break;
            case 3:
                $idcarro= $_POST['idcarro'];
                $pago= $_POST['pago'];
                $cantidad= $_POST['cantidad'];
                $precio= $_POST['precio'];
                $subtotal= $_POST['subtotal'];
                $CarritoModel->ActCantidad($idcarro,$pago,$cantidad,$precio,$subtotal);
                break;

    }
}else{
    header('Location: ./carrito.php');
}
?>