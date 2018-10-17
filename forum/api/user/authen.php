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

$userData = [];

//get post data from client
$jsonData = Utility::getJsonData();

$username = $jsonData->_username;
$pwd = $jsonData->_pwd;

//find duplicate user in database
$query = "SELECT id, username, created, picture, email FROM user_account WHERE username=:user_name AND hashed_password=:password";
$database->query($query);
$database->bind(":user_name", $username);
$database->bind(":password", $pwd);
$userData = $database->resultSingle();

if(!empty($userData)){
    $userData['picture'] = ($userData['picture']) ? __ASSETS_IMG_API_URL.$userData['picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
    $serverStatus = array('status' =>1,'message'=>'Logined successfully');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Logined fail please try again.');
}

echo json_encode(array('data'=>$userData, 'server_status'=>$serverStatus));

//close database connection
$database->closeConnection();