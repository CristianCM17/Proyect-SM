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

    function delete($id){
        $query="DELETE FROM carrito WHERE idpago=".$id;
        $this->db->Execute($query);
         //$this->getAll();
         echo "Producto eliminado de tu carrito";
    }

    function ActCantidad($idcarro,$pago,$cantidad,$precio,$subtotal){
        $pagos= array();  //crea un arreglo
        $pagos['pago']=$pago;
        $pagos['cantidad']=$cantidad;
        $pagos['precio']=$precio;
        $pagos['subtotal']=$precio*$cantidad;

        $this->db->autoExecute('carrito', $pagos,'UPDATE','idcarro = '.'\''.$idcarro.'\''); //hace el update
        echo "se actualizo la cantidad";

    }

}




?>