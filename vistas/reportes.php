<?php
require_once '../models/VentaModel.php';
require_once '../models/conexion.php';
include_once '../adodb5/adodb.inc.php';
require_once '../assets/dompdf/autoload.inc.php';







   
    $ventaModel= new VentaModel;
    $idventa = $_POST['idventa'];

    $venta_detalle=$ventaModel->getAllVenta_DetallePorId($idventa);
    $tabla='<div style="text-align: center;">
    <h1>Todos sus pagos de la venta</h1>
   </div>
    ';
    $tabla.='<table style="border-collapse: collapse; width: 100%;">
    <tr style="border: 1px solid #dddddd; text-align: center; padding: 8px;">
      <th>ID Venta</th>
      <th>ID Pago</th>
      <th>Precio</th>
      <th>Cantidad</th>
    </tr>';


    while (!$venta_detalle->EOF) {
     
        $tabla .= '<tr style="border: 1px solid #dddddd; text-align: center; padding: 8px;">
    <td>' . $venta_detalle->fields[0] . '</td>
    <td>' . $ventaModel->nombrePago($venta_detalle->fields[1]) . '</td>
    <td>$' . $venta_detalle->fields[2] . '</td>
    <td>' .$venta_detalle->fields[3] . '</td>
  </tr>';
     
        $venta_detalle->MoveNext();
     
    }

    $tabla .= '<div style="text-align: center; margin-top: 10px;">
    <h2>Total: $'. $ventaModel->totalVenta($idventa).'</h2>
    </div>';
   



    use Dompdf\Dompdf;
    $html=$tabla;
    $dompdf= new Dompdf();    
    
    $options=$dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
   $dompdf->loadHtml($tabla);
    $dompdf->setPaper('letter');
    //$dompdf->setPaper('A4','landscape');
    $dompdf->render();
    $dompdf->stream("archivo_.pdf",array("Attachment"=> false));

 

?>