<?php
require_once '../models/UsuarioModel.php';
require_once '../models/VentaModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';

session_start();

if (isset($_GET['opc'])){
    $usuarioModel= new UsuarioModel;
    $ventaModel= new VentaModel;
    $idUsuario= $usuarioModel->buscarId($_SESSION['login']['email']);
    $ultimaVenta=$ventaModel->ultimaVenta();
    
    switch ($_GET['opc']) {
        case 1:
     //mapea la tabla de venta por usuario 
         historialVentas($ventaModel,$idUsuario);
            break;
    }

}

//mapear la tabla ventas
  function historialVentas($ventaModel,$idUsuario){
    $tabla="";
    $venta=$ventaModel->getAllVentasPorId($idUsuario);

    while (!$venta->EOF) {
      $tabla.=   
          ' <tr>
              <td>
              <form method="post" action="../vistas/reportes.php">
                    <input type="hidden" name="idventa" value="'.$venta->fields[0].'">
                  <button type="submit" class="btn btn-primary" onclick="reporte('.$venta->fields[0].')">Detalle</button>
                </form>
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