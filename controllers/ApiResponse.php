<?php 


class ApiResponse{

    private $data;
    private $status;
    private $code;
    private $message;


    public function __construct() {
        $this->data=[];
        $this->code=200;
        $this->status=true;
        $this->message=[];
    }

    public function addData($key, $data){
        $this->data[$key]=$data;
    }

    private function addMessage($title, $message, $code, $type){
        $this->message=[
            'title'=>$title,
            'message'=>$message,
            'type'=>$type
        ];
    }

    public function addErrorMessage($message, $title='An error was ocurred', $code=500){
        $this->addMessage($title, $message, $code, 'error');
    }

    public function addErrorSuccess($message, $title='Ok!', $code=200){
        $this->addMessage($title, $message, $code, 'success');

    }

    public function getResponse(){
        return [
            'status'=>$this->status,
            'code'=>$this->code,
            'data'=>$this->data,
            'message'=>$this->message
        ];
    }
}