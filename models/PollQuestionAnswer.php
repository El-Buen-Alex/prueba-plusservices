<?php
require_once 'config/conection.php';


class PollQuestionAnswer{

    private $con;
    public function __construct(){
        $this->con = Connection::getConexion();
    }

    public function save($num_question, $code_poll, $calification, $poll_answer_id){
        $sql="INSERT INTO respuesta_pregunta (`num_pregunta`, `codigo_encuesta`, `califica`, `codigo_respuesta`) 
            values (:num_pregunta, :codigo_encuesta, :califica, :codigo_respuesta)";
        $sentencia = $this->con->prepare($sql);
        $data=[
            'codigo_encuesta'=>$code_poll,
            'num_pregunta'=>$num_question,
            'califica'=>intval($calification)*4,
            'codigo_respuesta'=>$poll_answer_id,
        ];
        $sentencia->execute($data);
        //execute
        if ($sentencia->rowCount() <= 0) {// verificar si se inserto 
            //rowCount permite obtner el numero de filas afectadas
            return -1;
        }
        return  $this->con->lastInsertId();;
    }
}