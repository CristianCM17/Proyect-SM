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



      public function editar($idpago,$pago,$precio,$descripcion,$periodo){
        $pagos= array();  //crea un arreglo
        $pagos['pago']=$pago;
        $pagos['precio']=$precio;
        $pagos['descripcion']=$descripcion;
        $pagos['periodo']=$periodo;

        $this->db->autoExecute('pagos', $pagos,'UPDATE','idpago = '.'\''.$idpago.'\''); //hace el update
      }

      public function insertar($pago,$precio,$descripcion,$periodo){
        $pagos= array();  //crea un arreglo
        
        $pagos['pago']=$pago;
        $pagos['precio']=$precio;
        $pagos['descripcion']=$descripcion;
        $pagos['periodo']=$periodo;

        $this->db->autoExecute('pagos', $pagos,'INSERT'); //hace el update
       
      }

      function eliminar($id){
        $query="DELETE FROM pagos WHERE idpago=".$id;
        $this->db->Execute($query);
    }


    
  }

?>