<?php

class conexion{

    private $DBType = 'mysqli';
    private $DBServer = 'localhost'; // server name or IP address
    private $DBUser = 'root';
    private $DBPass = '';
    private $DBName = 'sm';
    
    public function __construct(){}

    public function conectar(){
        $con = adoNewConnection($this->DBType);
        $con->debug = false;
        $con->connect($this->DBServer,$this->DBUser,$this->DBPass,$this->DBName);
        return $con;

    }
}



?>