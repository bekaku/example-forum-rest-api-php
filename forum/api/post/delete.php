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


$postId = Utility::filterGetString("_post_id");

//delete votes data from this post
$query = "DELETE v FROM votes v ";
$query .= "LEFT JOIN post p ON v.post_id = p.id ";
$query .= "WHERE p.id =:post_id ";
$database->query($query);
$database->bind(":post_id", (int)$postId);
$database->execute();

//delete post from db
$query = "DELETE FROM post WHERE id=:post_id";
$database->query($query);
$database->bind(":post_id", (int)$postId);
$database->execute();


if($database->execute()){
    $serverStatus = array('status' =>1,'message'=> 'Post was deleted.');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Unable to delete post.');
}

echo json_encode(array('data' => $serverStatus));

//close database connection
$database->closeConnection();