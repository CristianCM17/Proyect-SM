<?php 
require_once '../models/pagosModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

      $mensaje="";
      session_start();   

    /*if (isset($_GET['opc'])){
        $pagosModel= new PagosModel();
   
        //recuperamos el valor de la url de opc
        switch ($_GET['opc']) {
             case 1: //insert
                $id = $_POST['idPago'];
                 $pagosModel->agregarCarrito($id);
                  break;
                  } 
        }else {
           header('location: ../index.html'); //redirecciona a la pagina principal
        }*/

        //cuando no hay productos
        if(!isset($_SESSION['CARRITO'])){
         $pago= array();       //En una tabla parametrizada solo es atributo y valor
         $pago['idpago']=$_POST['idpago']; //agregamos los parametros de la tabla que se recuperan del POST
         $pago['pago']=$_POST['pago'];
         $pago['cantidad']=$_POST['cantidad'];
         $pago['precio']=$_POST['precio'];

         $_SESSION['CARRITO'][0]=$pago;
        
        }else{
         //si existe algo en el carrito contabiliza cuantos productos hay
            $NumeroPagos=count($_SESSION['CARRITO']);

            $pago= array();       //En una tabla parametrizada solo es atributo y valor
            $pago['idpago']=$_POST['idpago']; //agregamos los parametros de la tabla que se recuperan del POST
            $pago['pago']=$_POST['pago'];
            $pago['cantidad']=$_POST['cantidad'];
            $pago['precio']=$_POST['precio'];

            $_SESSION['CARRITO'][$NumeroPagos]=$pago;
        }
        $mensaje=print_r($_SESSION,true);
?>