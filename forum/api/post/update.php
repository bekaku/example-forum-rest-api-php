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
$postId = Utility::filterPostString("_post_id");
$data = array(
    "content" => Utility::filterPostString("_content"),
);
$status = $database->updateHelper('post',$data, array('id' => $postId));
if($status){
    $serverStatus = array('status' =>1,'message'=> 'Post was updated.');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Unable to update post.');
}

echo json_encode(array('data' => $serverStatus));

//close database connection
$database->closeConnection();