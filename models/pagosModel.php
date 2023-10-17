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

    public function agregarCarrito($idpago, $cantidad,$precio){
     /*  $query = "SELECT precio FROM pagos WHERE idpago = $idpago";
       $rs=$this->db->Execute($query);
       $row=$rs->FetchRow();
       $precio = $row['precio'];*/
       $checkQuery = "SELECT COUNT(*) AS count FROM carrito WHERE idpago = $idpago";
       $checkResult = $this->db->GetOne($checkQuery);

       if ($checkResult<1) {
        $carrito= array();
       $carrito['idpago']=$idpago;
       $carrito['cantidad']=$cantidad;
       $carrito['precio']=$precio;

       $this->db->autoExecute('carrito',$carrito,'INSERT'); //hace el insert
       } else {
          echo "Ese producto ya esta en el carrito";
       }

       
       
    }
    
  }

?>