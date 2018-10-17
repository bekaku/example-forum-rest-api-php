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
$serverStatus = array('status' =>1,'message'=>'Created user successfully');

//get post data from client
$jsonData = Utility::getJsonData();

//$data = array(
//    "username" => Utility::filterPostString("_username"),
//    "hashed_password" => Utility::filterPostString("_pwd"),
//    "created" => Utility::getDateNow(true),
//    "picture" => Utility::filterPostString("_picture"),
//    "email" => Utility::filterPostString("_email"),
//    );

$data = array(
    "username" => $jsonData->_username,
    "hashed_password" => $jsonData->_pwd,
    "created" => Utility::getDateNow(true),
    "picture" => $jsonData->_picture,
    "email" => $jsonData->_email,
);


//find duplicate user in database
$query = "SELECT * FROM user_account WHERE username=:user_name";
$database->query($query);
$database->bind(":user_name", $data['username']);
$userDuplicate = $database->resultSingle();

if(!empty($userDuplicate)){
    $serverStatus = array('status' =>0,'message'=> 'The username '.$data['username'].' already exists. Please choose another username and try again.');
}else{
    //insert user data to database and get last user id
    $lastInsertId = $database->insertHelper('user_account', $data);
    //get last user data and respons to cilent
    if($lastInsertId){
        $query = "SELECT id, username, created, picture, email FROM user_account WHERE id=:user_id";
        $database->query($query);
        $database->bind(":user_id", (int)$lastInsertId);
        $userData = $database->resultSingle();
        if(!empty($userData)){
            $userData['picture'] = ($userData['picture']) ? __ASSETS_IMG_API_URL.$userData['picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
        }
    }else{
        $serverStatus = array('status' =>0,'message'=> 'Someting went wrong. Please try again.');
    }
}

echo json_encode(array('data'=>$userData, 'server_status'=>$serverStatus));

//close database connection
$database->closeConnection();