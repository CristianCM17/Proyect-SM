<?php
require_once '../models/UsuarioModel.php';
require_once '../models/VentaModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

session_start();

if (isset($_GET['opc'])){
    $usuarioModel= new UsuarioModel;
    $ventaModel= new VentaModel;
    //$idUsuario= $usuarioModel->buscarId($_SESSION['login']['email']);
    $ultimaVenta=$ventaModel->ultimaVenta();
    
    switch ($_GET['opc']) {
        case 1:
     //mapea la tabla de venta por usuario 
         historialVentas($ventaModel);
            break;
    }

}

//mapear la tabla ventas
  function historialVentas($ventaModel){
    $tabla="";
    $venta=$ventaModel->getAllVentas();

    while (!$venta->EOF) {
      $tabla.=   
          ' <tr>
              <td>
                  <button class="btn btn-primary">Detalle</button>
              </td>
              <td>'.$venta->fields[0].'</td>
              <td>'.$venta->fields[2].'</td>
              <td>'.$venta->fields[3].'</td>
              <td>'.$venta->fields[4].'</td>
          </tr>';
      $venta->MoveNext();
    }

    echo $tabla;
  }
?>