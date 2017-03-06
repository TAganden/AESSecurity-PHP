<?php

require 'cryptAES.class.php';

class indexController {

 public function index() {
        $dataArr = ["name" => "leafly",
                    "job" => "iOS Developer"];
        $cryptObj = new cryptAES(128, "zq9GFxgbh9nWFdjO", "0123456789", "ecb");
        $jsonString = json_encode($dataArr);
        $dataArr = $cryptObj->encrypt($jsonString);
        $response = ['status' => 200,
                     'info' => $dataArr,
                     'msg' => '请求成功'];
        $this->data2json($response);
 }

 function data2json($data) {
     echo json_encode($data);
     exit();
 }
}

$obj = new indexController();
$obj->index();

