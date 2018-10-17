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

//get post data from client
$userId = Utility::filterPostString("_user_id");
$password = Utility::filterPostString("_pwd");
if(!empty($password)){
    $data = array(
        "hashed_password" => $password,
        "picture" => Utility::filterPostString("_picture"),
        "email" => Utility::filterPostString("_email"),
    );
}else{
    $data = array(
        "picture" => Utility::filterPostString("_picture"),
        "email" => Utility::filterPostString("_email"),
    );
}

$status = $database->updateHelper('user_account',$data, array('id'=>$userId));
if($status){
    $serverStatus = array('status' =>1,'message'=> 'User was updated.');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Unable to update user.');
}

echo json_encode(array('data' => $serverStatus));

//close database connection
$database->closeConnection();