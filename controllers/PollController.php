<?php

require_once 'models/PollModel.php';
require_once 'models/PollQuestion.php';
require_once 'models/PollAnswer.php';
require_once 'models/PollQuestionAnswer.php';
require_once 'controllers/Controller.php';
class PollController extends Controller {

    public function index() {
        require_once 'views/index.php';
    }

    public function create(){
        try{
            $pollModel=new PollModel();
            $response=$pollModel->all();
            $this->apiResponse->addData('polls', $response);
        }catch(Exception $e){
            $this->apiResponse->addErrorMessage($e->getMessage());
        }
        echo $this->result();
    }

    public function questions(){
        try{
            
            $pollCode=  isset($_GET['poll_code']) ? $_GET['poll_code'] : null;
            if(!$pollCode){
                throw new Exception('No se ha encontrado el codigo de encuesta');
            }
            $pollModel=new Pollquestion();
            $response=$pollModel->getByPollCode($pollCode);
            $this->apiResponse->addData('questions', $response);
        }catch(Exception $e){
            $this->apiResponse->addErrorMessage($e->getMessage());
        }
        echo $this->result();
    }

    public function save(){
        try{

            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);
            $pollCode=  isset($data['code_poll']) ? $data['code_poll'] : null;
            $pollRows=  isset($data['rows']) ? $data['rows'] : null;
            
            if(!$pollCode){
                throw new Exception('No se ha encontrado el codigo de encuesta');
            }
            if(!$pollRows || !is_array($pollRows)){
                throw new Exception('No se ha encontrado las repuestas de la encuesta');
            }

            $pollAnswerModel=new PollAnswer();
            $pollAnswerId=$pollAnswerModel->save($pollCode, $pollRows);
            if($pollAnswerId['status']){
                $this->apiResponse->addSuccessMessage('Respuesta guardada correctamente');
            }else{
                $this->apiResponse->addErrorMessage($pollAnswerId['message']);
            }
        }catch(Exception $e){
            $this->apiResponse->addErrorMessage($e->getMessage());
            $this->apiResponse->addData('line_error', $e->getLine());
        }
        echo $this->result();
    }
}
?>