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

    public function getResults(){
        $sql="SELECT encuestas.codigo_encuesta, encuestas.nombre_encuesta, count(distinct(respuesta_encuesta.codigo_respuesta)) as responses_count, round( avg(respuesta_pregunta.califica), 2) as avg_calification FROM encuestas
            inner join respuesta_encuesta on respuesta_encuesta.codigo_encuesta=encuestas.codigo_encuesta
            inner join respuesta_pregunta on respuesta_pregunta.codigo_encuesta=encuestas.codigo_encuesta
            group by encuestas.codigo_encuesta";
        $sentencia = $this->con->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }
}