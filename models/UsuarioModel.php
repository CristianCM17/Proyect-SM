<?php

class UsuarioModel{

    public function __construct(){
      $con = new Conexion();
      $this->db = $con->conectar();
  }

  public function insertar($nombre,$email,$contrasena,$latitud,$longitud){
      $usuario= array();  //crea un arreglo
      
      $usuario['nombre']=$nombre;
      $usuario['email']=$email;
      $usuario['constrasena']=$contrasena;
      $usuario['latitud']=$latitud;
      $usuario['longitud']=$longitud;

      $this->db->autoExecute('usuario', $usuario,'INSERT'); //hace el update
     
    }
    //se busca el id del usuario registrado
    public function buscarId($email){
      $query = "SELECT idusuario FROM usuario where email = '$email'";
      $reslts = $this->db->Execute($query);
      $fila= $reslts->FetchRow();
      return $fila['idusuario'];
    }

    //darle un rol l usuario insertado que por defecto sera 2
    public function insertarUsRol($email){
     $idusuario= $this->buscarId($email);

     $usuario= array();  //crea un arreglo
      
     $usuario['idusuario']=$idusuario;
     $usuario['idrol']=2;
     

     $this->db->autoExecute('usuario_rol', $usuario,'INSERT'); //hace el update

    }

    //validar que el email no se repita
    public function validarEmail($email){
      //contar cuantos emails hay pareceidos al que quiere insertar
      $query = "SELECT COUNT(email) AS email FROM usuario where email = '$email'";
      $reslts = $this->db->Execute($query);
      $fila= $reslts->FetchRow();
      $contador = $fila['email'];
      //validar si hay o no hay
      if ($contador==1) {
          return true;
      }else {
        return false;
      }
    }

    public function validarLogin($email,$contrasena){
        $query= "SELECT constrasena FROM usuario WHERE email= '$email'";
        $reslts= $this->db->Execute($query);
        $fila= $reslts->FetchRow();
        $conHash= $fila['constrasena'];

        if (password_verify($contrasena, $conHash)) {
            return true;
        }else return false;
    }
  }

?>