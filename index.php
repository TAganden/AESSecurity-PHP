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
 
 public function upload() {
     $postParam = getGP("post");
     if (isset($postParam)) {
         var_dump($postParam);
//       $postParam = "mHi9rqEIA/j70JVx1pp5mFMju/BtRPE/CTTHR9HnG2U=";
       $cryptObj = new cryptAES(128, "zq9GFxgbh9nWFdjO", "0123456789", "ecb");
       $jsonString = $cryptObj->decrypt($postParam);
//       $dataArr = json_decode($jsonString);
       $response = ['status' => 200,
                    'info' => $jsonString,
                    'msg' => '请求成功'];
                
       $this->data2json($response);
     } else {
       $response = ['status' => 403,
                    'msg' => '参数错误'];
                
       $this->data2json($response);   
     }
 }

 function data2json($data) {
     echo json_encode($data);
     exit();
 }
 
}

function getGP($param) {
    // 先判断POST参数中是否包含此参数, 如果包含直接返回
    if (isset($_POST[$param])) {
        return $_POST[$param];
    }
    
    // 再判断GET参数中是否包含此参数，如果包含直接返回
    if (isset($_GET[$param])) {
        return $_GET[$param];
    }
    
    return '';
}

$act = getGP("act") ? getGP("act") : index;

$obj = new indexController();
$obj->$act();

