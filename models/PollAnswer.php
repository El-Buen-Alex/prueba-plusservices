<?php
require_once 'models/PollQuestion.php';
require_once 'config/conection.php';


class PollAnswer{

    private $con;
    public function __construct(){
        $this->con = Connection::getConexion();
    }

    public function save($code_poll, $pollRows){
        try{
            $status=true;
            $message='';
           // $this->con->beginTransaction();
            $sql="INSERT INTO respuesta_encuesta (`codigo_encuesta`, `fecha_respuesta`) values (:codigo_encuesta, :created_at)";
            $sentencia = $this->con->prepare($sql);

            $data=[
                'codigo_encuesta'=>intval($code_poll),
                'created_at'=>date("Y-m-d H:i:s"),
            ];

            $sentencia->execute($data);

            if ($sentencia->rowCount() <= 0) {
                return -1;
            }
            $pollAnswerId=$this->con->lastInsertId();
            $pollQuestionAnswer= new PollQuestionAnswer();
            $pollModel=new Pollquestion();
            $questions=$pollModel->getByPollCode($code_poll);
            foreach($questions as $currentQuestion){
                $codeQuestion=$currentQuestion['num_pregunta'];
                //search in rows for ensure that data is ok
                $result=null;
                foreach ($pollRows as $currentAnswer) {
                    if($currentAnswer['question_number']==$codeQuestion){
                        $result=$currentAnswer;
                        break;
                    }
                }
                if(!$result){
                    throw new Exception('No se ha encontrado la repuesta de la pregunta ' . $currentQuestion['descripcion']);
                }
                $newVal=$pollQuestionAnswer->save(
                    $codeQuestion,
                    $code_poll,
                    $result['calification'],
                    $pollAnswerId
                );
                if($newVal==-1){
                    throw new Exception('No se pudo guardar la repuesta de la pregunta ' . $currentQuestion['descripcion']);
                }
                //unset($currentAnswer);
            }
            //$this->con->commit();
        }catch(Exception $e){
           // $this->con->rollBack();
            $status=false;
            $message=$e->getMessage();
        }

        return  [
            'status'=>$status,
            'message'=>$message
        ];
    }
}