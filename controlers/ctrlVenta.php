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
           //$ventaModel->completarVenta();
           //unset($_SESSION['carrito']);

           MandarEmail($ultimaVenta);
          

            break;
    }

}

 function MandarEmail($ultimaVenta){
    $destino ="cristiandavidcardoso@gmail.com"; //$_SESSION['login']['email'];
    $asunto = 'Sus pagos han sido Pagados exitosamente';
    //tpdl bptn ehgt itlu
      // Inicializar la variable de la tabla
    $cuerpo = '<table style="border-collapse: collapse; width: 100%;">
    <tr style="border: 1px solid #dddddd; text-align: left; padding: 8px;">
      <th>ID Venta</th>
      <th>ID Pago</th>
      <th>Precio</th>
      <th>Cantidad</th>
    </tr>';

    // Mapear los datos y agregar filas a la tabla
    foreach ($_SESSION['carrito'] as $key => $producto) {
    $cuerpo .= '<tr style="border: 1px solid #dddddd; text-align: center; padding: 8px;">
          <td>' . $ultimaVenta . '</td>
          <td>' . $producto['idpago'] . '</td>
          <td>$' . $producto['precio'] . '</td>
          <td>' . $producto['cantidad'] . '</td>
        </tr>';
    }

    // Cerrar la etiqueta de la tabla
    $cuerpo .= '</table>';


    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: cristiandavidcardoso@gmail.com\r\n";
    $headers .= "Return-Path: $destino\r\n";

    mail($destino,$asunto,$cuerpo,$headers);

    echo "correo mandado";

}

?>