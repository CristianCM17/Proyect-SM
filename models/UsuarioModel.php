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
  }

?>