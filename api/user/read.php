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
//open coonnection to database
$database->getConnection();

//select all user_account from database
$query = "SELECT id, username, created, picture, email FROM user_account ";
$query .= "ORDER BY username ASC ";
$query .= "LIMIT :starting_position , :records_per_page ";

$database->query($query);
$database->bind(":starting_position" , $_startingPosition);
$database->bind(":records_per_page" , $_recordsPerPage);

$finalList = array();
$tmpUsersList = $database->resultList();
if(!empty($tmpUsersList)){
    foreach ($tmpUsersList AS $tmpUser){
        $tmpUser['picture'] = ($tmpUser['picture']) ? __ASSETS_IMG_API_URL.$tmpUser['picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
        array_push($finalList, $tmpUser);
    }
}
echo json_encode(array('data' => $finalList));


//close database connection
$database->closeConnection();