<?php


 class VentaModel{

    public function __construct(){
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    public function getAllVentasPorId($idUsuario){
        $query = "SELECT * FROM `venta` where idusuario= '$idUsuario'";
        $rs = $this->db->Execute($query);
        
        return $rs;
      }

      public function getAllVenta_DetallePorId($idventa){
        $query = "SELECT * FROM venta_detalle where idventa= '$idventa'";
        $rs = $this->db->Execute($query);
        
        return $rs;
      }

    

    public function insertarVenta($idUsuario,$total){
        
        $venta= array();

        $venta['idusuario']=$idUsuario;
        $venta['total']=$total;
        $venta['estado']='En proceso';

        $this->db->autoExecute('venta', $venta,'INSERT');
    }

    public function editaridTransaccion($idTransaccion){
        $idventa= $this->ultimaVenta();
        $venta= array();  //crea un arreglo
        $venta['idtransaccion']=$idTransaccion;
        $venta['estado']="Completado";
        

        $this->db->autoExecute('venta', $venta,'UPDATE','idventa = '.'\''.$idventa.'\''); //hace el update
      }

    public function CompletarVenta(){
        //encontar la ultima venta 
        $idventa= $this->ultimaVenta();

        
        //por cada indice hace un array que despues se inserta en venta_detalle
        foreach($_SESSION['carrito'] as $key => $producto){
            $arreglo= array();

            $arreglo['idventa']=$idventa;
            $arreglo['idpago']=$producto['idpago'];
            $arreglo['precio']=$producto['precio'];
            $arreglo['cantidad']=$producto['cantidad'];

            $this->db->autoExecute('venta_detalle', $arreglo,'INSERT');
        }
    }

    //recupera el total de la venta
    public function totalVenta($idventa){
        $sql = "SELECT total FROM venta where idventa='$idventa'";
        $result = $this->db->Execute($sql);
        $fila = $result->FetchRow();
        $total = $fila['total'];

        return $total;
    }


    //encontrar la ultima venta
    public function ultimaVenta(){
        $sql = "SELECT * FROM venta ORDER BY idventa DESC LIMIT 1";
        $result = $this->db->Execute($sql);
        $fila = $result->FetchRow();
        $idventa = $fila['idventa'];

        return $idventa;
    }

    public function nombrePago($idpago){
        $sql = "SELECT pago AS pago FROM pagos where idpago = '$idpago'";
        $result = $this->db->Execute($sql);
        $fila = $result->FetchRow();
        $pago = $fila['pago'];

        return $pago;
    }


    public function graficarVentas($fechaInicioFormato,$fechaFinFormato){
        $query = "SELECT p.pago, COUNT(p.pago) as contador
          FROM pagos p
          JOIN venta_detalle vd ON vd.idpago = p.idpago
          JOIN venta v ON v.idventa = vd.idventa
          WHERE v.fecha BETWEEN '$fechaInicioFormato' AND '$fechaFinFormato'
          GROUP BY 1";
          
        $reslts = $db->Execute($query);

        // Construye un array asociativo con los datos
        $datos = array();
        while ($fila = $reslts->FetchRow()) {
            $datos[] = array($fila["pago"], $fila["contador"]);
        }

        // Convierte el array a formato JSON y lo imprime
        echo json_encode($datos);
    }
}


?>