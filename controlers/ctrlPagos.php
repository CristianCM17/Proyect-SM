<?php 
require_once '../models/pagosModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';


  session_start();

         if( isset($_GET['opc']) ){
            $pagosModel= new PagosModel();
    
            switch($_GET['opc']){//insertar en carrito
                case 1: 
                     
                  $idpago= $_POST['idpago'];
                  $cantidad= $_POST['cantidad'];
                  $precio= $_POST['precio'];
                  $pago=$_POST['pago'];

                   //si no tiene nada la session carrito
                   if (!isset($_SESSION['carrito'])) {
                    $pagos= array(
                      'idpago'=>$idpago,
                      'pago'=>$pago,
                      'cantidad'=>$cantidad,
                      'precio'=>$precio,                    
                    );
                  //creamos la session carrito y en su posicion 0 le damos el array pagos
                  $_SESSION['carrito'][0] = $pagos;
                  }else {

                    $idpagos= array_column($_SESSION['carrito'],'idpago');//idpagos tendra todos los id de la session
                    //si el id solicitado esta en idpagos entonces
                    if (in_array($idpago,$idpagos)) {
                        echo '<script>alert("El producto ya ha sido seleccionado")</script>';
                    }else {

                    //cuenta cuantos indices hay en la session carrito
                    $numPagos= count($_SESSION['carrito']);

                    $pagos= array(
                      'idpago'=>$idpago,
                      'pago'=>$pago,
                      'cantidad'=>$cantidad,
                      'precio'=>$precio                    
                    );
                    //el array se pone en una posicion mas de las ya existentes
                    $_SESSION['carrito'][$numPagos] = $pagos;
                   }
                  }
                  //contamos la cantidad de elementos del carrito
                 if (empty($_SESSION['carrito'])){
                  echo 0;
                 }else echo count($_SESSION['carrito']);
                /*  foreach ($_SESSION['carrito'] as $index => $item) {
                    echo "Índice $index:<br>";
                    foreach ($item as $clave => $valor) {
                        echo "$clave => $valor<br>";
                    }
                    echo "<br>";
                }*/

                    break;
                 case 2: //actualizar
                $idpago= $_POST['hddid'];
                $pago= $_POST['txtpago'];
                $precio= $_POST['txtPrecio'];
                $descripcion=$_POST['txtDescripcion'];
                $periodo=$_POST['txtPeriodo'];
                $pagosModel->editar($idpago,$pago,$precio,$descripcion,$periodo);
                obtenerPagos($pagosModel);
                break;
                
                case 3://eliminar
                    $idpago= $_POST['idpago'];
                    $pagosModel->eliminar($idpago);
                    obtenerPagos($pagosModel);
                    break;

                case 4://insertar
                    $pago= $_POST['txtpago'];
                    $precio= $_POST['txtPrecio'];
                    $descripcion=$_POST['txtDescripcion'];
                    $periodo=$_POST['txtPeriodo'];
                    $pagosModel->insertar($pago,$precio,$descripcion,$periodo);
                    obtenerPagos($pagosModel);
                    break;
                case 5:
                    obtenerPagos($pagosModel);
                    break;
                case 6:
                    obtenerPagosCliente($pagosModel);
                    break;

            }
        }else{
            header('Location: ./pagos.php');
        }

      function obtenerPagos($pagosModel){
        $obtener='';
        $pagos=$pagosModel->getAll();
        while(!$pagos->EOF){
            $obtener.=
        '<div class="col-sm-6 cartas">
        <div class="card">
          <div class="card-body cartasbody" id="carta">
          <h2 class="card-title">'.$pagos->fields[1].'</h5>
          <h3 class="card-subtitle mb-2 text-muted">$'.$pagos->fields[2].'</h6>
          <p class="card-text">'.$pagos->fields[3].' '.$pagos->fields[4].'</p>

          <form id="'.$pagos->fields[0].'">
            <input type="hidden" name="idpago" id="idpago" value="'.$pagos->fields[0].'">
            <input type="hidden" name="pago" id="pago" value="'.$pagos->fields[1].'">
            <input type="hidden" name="precio" id="precio" value="'.$pagos->fields[2].'">
            <input type="hidden" name="cantidad" id="cantidad" value="'. 1 .'">
         
          <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="mandar('.$pagos->fields[0].')">Actualizar</button>
          <button type="button" class="btn btn-danger" onclick="eliminar('.$pagos->fields[0].')">Eliminar</button>
          </form>
          </div>
        </div>
      </div>';
        

              $pagos->MoveNext();
        }
        echo  $obtener;
      }

      function obtenerPagosCliente($pagosModel){
        $obtener='';
        $pagos=$pagosModel->getAll();
        while(!$pagos->EOF){
            $obtener.=
        '<div class="col-sm-6 cartas">
        <div class="card">
          <div class="card-body cartasbody" id="carta">
          <h2 class="card-title">'.$pagos->fields[1].'</h5>
          <h3 class="card-subtitle mb-2 text-muted">$'.$pagos->fields[2].'</h6>
          <p class="card-text">'.$pagos->fields[3].' '.$pagos->fields[4].'</p>

          <form id="'.$pagos->fields[0].'">
            <input type="hidden" name="idpago" id="idpago" value="'.$pagos->fields[0].'">
            <input type="hidden" name="pago" id="pago" value="'.$pagos->fields[1].'">
            <input type="hidden" name="precio" id="precio" value="'.$pagos->fields[2].'">
            <input type="hidden" name="cantidad" id="cantidad" value="'. 1 .'">
          
            <button onclick="agregarCarrito('.$pagos->fields[0].')" class="btn btn-primary" type="button">Agregar Carrito</button>
          </form>
          </div>
        </div>
      </div>';
        

              $pagos->MoveNext();
        }
        echo  $obtener;
      }
?>