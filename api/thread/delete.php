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



$threadId = Utility::filterGetString("_thread_id");

//delete votes data from this thread
$query = "DELETE v FROM votes v ";
$query .= "WHERE v.threads_id =:thread_id ";
$database->query($query);
$database->bind(":thread_id", (int)$threadId);
$database->execute();

//delete post from this thread
$query = "DELETE FROM post WHERE threads_id=:threads_id";
$database->query($query);
$database->bind(":threads_id", (int)$threadId);
$database->execute();

//finaly delete thread by id
$query = "DELETE FROM threads WHERE id=:id";
$database->query($query);
$database->bind(":id", (int)$threadId);
$database->execute();


if($database->execute()){
    $serverStatus = array('status' =>1,'message'=> 'Thread was deleted.');
}else{
    $serverStatus = array('status' =>0,'message'=> 'Unable to delete thread.');
}

echo json_encode(array('server_status' => $serverStatus));

//close database connection
$database->closeConnection();