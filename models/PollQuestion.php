<?php
require_once 'config/conection.php';


class Pollquestion{

    private $con;
    public function __construct(){
        $this->con = Connection::getConexion();
    }

    public function getByPollCode($pollCode){
        $sql="select * from preguntas_encuesta  where codigo_encuesta=:code order by num_pregunta asc";
        $sentencia = $this->con->prepare($sql);
        $data=[
            'code'=>$pollCode
        ];
        $sentencia->execute($data);
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }
}