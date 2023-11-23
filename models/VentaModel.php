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
}


?>