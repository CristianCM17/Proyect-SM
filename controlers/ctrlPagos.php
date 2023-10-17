<?php 
require_once '../models/pagosModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';




         if( isset($_GET['opc']) ){
            $pagosModel= new PagosModel();
    
            switch($_GET['opc']){
                case 1: // INSERT TO DB
                  $idpago= $_POST['idpago'];
                  $cantidad= $_POST['cantidad'];
                  $precio= $_POST['precio'];
                  
                  $pagosModel->agregarCarrito($idpago,$cantidad,$precio);
                 // $mensaje=$idpago." ".$cantidad;
                    break;

                case 2: // UPDATE TO BD
                    
                    break;
                case 3: // DELETE TO DB
                 
                    break;
                case 4: // SELECT TO DB
                   
            }
        }else{
            header('Location: ./pagos.php');
        }

      


















      //session_start();   


      /*  if(isset($_POST['btnAccion'])){//validar que se dio cick al boton
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
        }*/
?>