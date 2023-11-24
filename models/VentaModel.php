<?php


 class VentaModel{

    public function __construct(){
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    public function insertarVenta($idUsuario,$total){
        
        $venta= array();

        $venta['idusuario']=$idUsuario;
        $venta['total']=$total;
        $venta['estado']='En proceso';

        $this->db->autoExecute('venta', $venta,'INSERT');
    }

    public function CompletarVenta(){
        $sql = "SELECT * FROM venta ORDER BY idventa DESC LIMIT 1";
        $result = $this->db->Execute($sql);
        $fila = $result->FetchRow();
        $idventa = $fila['idventa'];

        

        foreach($_SESSION['carrito'] as $key => $producto){
            $arreglo= array();

            $arreglo['idventa']=$idventa;
            $arreglo['idpago']=$producto['idpago'];
            $arreglo['precio']=$producto['precio'];
            $arreglo['cantidad']=$producto['cantidad'];

            $this->db->autoExecute('venta_detalle', $arreglo,'INSERT');
        }

      
    }
}


?>