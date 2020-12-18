<?php
/**
 * Created by PhpStorm.
 * User: developers
 * Date: 2/10/2018
 * Time: 3:42 PM
 */
include_once '../../core.php';
Utility::requiredJsonHeadersPost();

// instantiate database
$database = new Database();
//open connection to database
$database->getConnection();


$jsonData = Utility::getJsonData();
//get post data from client
$threadId =  $jsonData->_thread_id;
$data = [
    "subject" => $jsonData->_subject,
    "content" =>  $jsonData->_content,
];

$status = $database->updateHelper('threads',$data, array('id'=>$threadId));
if($status){
    $serverStatus = array('status' =>1,'message'=> 'Thread was updated.');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Unable to update thread.');
}

echo json_encode(array('server_status' => $serverStatus));

//close database connection
$database->closeConnection();