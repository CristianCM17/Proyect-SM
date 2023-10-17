<?php

class CarritoModel{

    public function __construct(){
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    function getAll(){
        $query = "SELECT * FROM carrito";
        $rs = $this->db->Execute($query);
        //print_r($rs->getRows());
        return $rs;
    }
}




?>