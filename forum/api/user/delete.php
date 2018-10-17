<?php
/**
 * Created by PhpStorm.
 * User: developers
 * Date: 2/10/2018
 * Time: 3:42 PM
 */
include_once '../../core.php';
Utility::requiredJsonHeadersGet();

// instantiate database
$database = new Database();
//open connection to database
$database->getConnection();

$userId = Utility::filterGetString("_user_id");
//get post data from client
$query = "DELETE FROM user_account WHERE id=:id";
$database->query($query);
$database->bind(":id", (int)$userId);
$database->execute();
if($database->execute()){
    $serverStatus = array('status' =>1,'message'=> 'User was deleted.');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Unable to delete user.');
}

echo json_encode(array('data' => $serverStatus));

//close database connection
$database->closeConnection();