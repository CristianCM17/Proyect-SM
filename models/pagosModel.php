<?php 

  class PagosModel{

    public function __construct(){
      $con = new Conexion();
      $this->db = $con->conectar();
  }

    public function getAll(){
      $query = "SELECT * FROM pagos";
      $rs = $this->db->Execute($query);
      //print_r($rs->getRows());
      return $rs;
    }

  /*  public function agregarCarrito($id){
        // Obtener el precio del producto desde la tabla de pagos (pago_id se pasa como parámetro)
        $idpago = $id; // Ajusta esto según cómo obtengas el pago ID

        $query = "SELECT * FROM pagos";
      $rs = $this->db->Execute($query);
      //print_r($rs->getRows());

    }*/
    
  }

?>