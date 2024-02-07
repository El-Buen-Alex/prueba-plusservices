<?php

require_once 'models/PollModel.php';
require_once 'models/PollQuestion.php';
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
}
?>