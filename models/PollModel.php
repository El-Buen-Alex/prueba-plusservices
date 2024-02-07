<?php
require_once 'config/conection.php';


class PollModel{

    private $con;
    public function __construct(){
        $this->con = Connection::getConexion();
    }

    public function all(){
        $sql="select * from encuestas  order by codigo_encuesta desc";
        $sentencia = $this->con->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }
}