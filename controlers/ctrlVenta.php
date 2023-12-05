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

    $ultimaVenta=$ventaModel->ultimaVenta();
    
    switch ($_GET['pro']) {
        case 1:
            $ventaModel->insertarVenta($idUsuario,$total);
            
            break;
        
        case 2:
          //recibir el idTransaccion del json de la venta
          $json = file_get_contents('php://input');
          $datos = json_decode($json, true);
          $idTransaccion=$datos['idTransaccion'];
        
         //hacer el detalle de la vanta
           $ventaModel->completarVenta();      
           MandarEmail($ultimaVenta,$ventaModel); //manda email con el detalle de la vanta*/
           $ventaModel->editaridTransaccion($idTransaccion); //agrega en venta la transaccion y el estatus
           unset($_SESSION['carrito']);   //borra el contenido del carrito   
           
            break;
        case 3: 
         //graficar
          $ventaModel->graficarVentas($fechaInicioFormato,$fechaFinFormato);

          break;
    }

}


 function MandarEmail($ultimaVenta,$ventaModel){
    $destino =$_SESSION['login']['email'];
    $asunto = 'Sus pagos han sido procesados exitosamente';
    //tpdl bptn ehgt itlu
      // Inicializar la variable de la tabla
    $cuerpo = '<table style="border-collapse: collapse; width: 100%;">
    <tr style="border: 1px solid #dddddd; text-align: center; padding: 8px;">
      <th>ID Venta</th>
      <th>ID Pago</th>
      <th>Precio</th>
      <th>Cantidad</th>
    </tr>';

    // Mapear los datos y agregar filas a la tabla
    foreach ($_SESSION['carrito'] as $key => $producto) {
    $cuerpo .= '<tr style="border: 1px solid #dddddd; text-align: center; padding: 8px;">
          <td>' . $ultimaVenta . '</td>
          <td>' . $ventaModel->nombrePago($producto['idpago']) . '</td>
          <td>$' . $producto['precio'] . '</td>
          <td>' . $producto['cantidad'] . '</td>
        </tr>';
    }

    // Cerrar la etiqueta de la tabla
    $cuerpo .= '</table>';
    $cuerpo .= '<h1>Total: <span style="border: 1px solid #dddddd;">$' . $_SESSION['total'] . '</span></h1>';


    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: cristiandavidcardoso@gmail.com\r\n";
    $headers .= "Return-Path: $destino\r\n";

    mail($destino,$asunto,$cuerpo,$headers);

   // echo "correo mandado";

}

?>