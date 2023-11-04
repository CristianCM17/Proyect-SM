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

  /*  public function agregarCarrito($idpago,$cantidad,$precio,$pago){

      //contamos cuantos pagos estan con el mismo id
        $checkQuery = "SELECT COUNT(*) AS count FROM carrito WHERE idpago = $idpago";
       $rs = $this->db->Execute($checkQuery);
       $row=$rs->FetchRow();
       $conteo = $row['count'];


           
        
      
       //cuando no tengamos ningun pago se inserta, cuando ya tengamos uno manda el echo
       if ($conteo>0) {
           echo "este prodcuto ya ha sido agregado";
       } else {
        $carrito= array();
        $carrito['idpago']=$idpago;
        $carrito['cantidad']=$cantidad;
        $carrito['precio']=$precio;
        $carrito['subtotal']=$precio;
        $carrito['pago']=$pago;
 
        $this->db->autoExecute('carrito',$carrito,'INSERT'); //hace el insert

       
        $query = "SELECT COUNT(*) AS contador FROM carrito";
        $reslts = $this->db->Execute($query);
        $fila= $reslts->FetchRow();
        $contador = $fila['contador'];
        echo $contador;
       }
    
       
       
    }*/

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