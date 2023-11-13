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
  }

?>