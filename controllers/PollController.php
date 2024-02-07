<?php

require_once 'models/PollModel.php';
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
}
?>