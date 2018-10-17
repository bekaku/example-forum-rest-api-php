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

$query = "SELECT id, username, created, picture, email FROM user_account WHERE id=:user_id";
$database->query($query);
$database->bind(":user_id", (int)$userId);
$userData = $database->resultSingle();
if(!empty($userData)){
    $userData['picture'] = ($userData['picture']) ? __ASSETS_IMG_API_URL.$userData['picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
}
echo json_encode(array('data' => $userData));

//close database connection
$database->closeConnection();