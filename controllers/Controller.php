

<?php
require_once 'controllers/ApiResponse.php';

class Controller{


    public  $apiResponse;

    public function __construct() {
        $this->apiResponse=new ApiResponse();
    }

    public function result(){
        return json_encode($this->apiResponse->getResponse());
    }
}