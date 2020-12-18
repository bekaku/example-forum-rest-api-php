<?php
/**
 * Created by PhpStorm.
 * User: developers
 * Date: 3/10/2018
 * Time: 3:27 PM
 */
include_once '../../core.php';
Utility::requiredJsonHeadersPost();



$test1 = Utility::filterPostString('param1');
$test2 = Utility::filterPostString('param2');
$serverStatus = array(
    'param1_www' => $test1,
    'param2_www' => $test2
);



// get posted data
//$data = Utility::getJsonData();
//$serverStatus = array(
//    'param1' => $data->param1,
//    'param2' => $data->param2
//);
echo json_encode($serverStatus);