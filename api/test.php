<?php
/**
 * Created by PhpStorm.
 * User: developers
 * Date: 2/10/2018
 * Time: 1:29 PM
 */
include_once '../core.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();


//select all
//$query = "SELECT * FROM user_account ";
//$database->query($query);
//$resultList = $database->resultList();
//print_r($resultList);

//select single
//$userId="1";
//$query = "SELECT * FROM user_account WHERE id=:user_id";
//$database->query($query);
//$database->bind(":user_id", (int)$userId);
//$userSingle = $database->resultSingle();
//print_r($userSingle);

//create user
//$data = array(
//    "username" => "test",
//    "hashed_password" => "test",
//    "created" => Utility::getDateNow(true),
//    "picture" => "test.jpg",
//    "email" => "test@gmail.com",
//    );
//$lastInsertId = $database->insertHelper('user_account', $data);
//echo "Last Insert Id =>".$lastInsertId;

//update user
//$dataUpdate = array(
//    "username" => "testxxxx",
//    "hashed_password" => "testxxxx",
//    "created" => Utility::getDateNow(true),
//    "picture" => "testxxxx.jpg",
//    "email" => "testxxxx@gmail.com",
//);
//$database->updateHelper('user_account',$dataUpdate, array('id'=>2), 'AND');

//delete user
//$userId = '2';
//$query = "DELETE FROM user_account WHERE id=:id";
//$database->query($query);
//$database->bind(":id", (int)$userId);
//$database->execute();

$avatarList = Utility::getDefaultAvatar();
print_r($avatarList);