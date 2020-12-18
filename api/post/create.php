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

$postData = [];

//get post data from client
$jsonData = Utility::getJsonData();

$data = array(
    "threads_id" => $jsonData->_thread_id,
    "content" => $jsonData->_content,
    "created" => Utility::getDateNow(true),
    "user_account_id" => $jsonData->_user_account_id,
);
//insert post data to database and get last id
$lastInsertId = $database->insertHelper('post', $data);

//get last post data and respons to cilent
if ($lastInsertId) {
    //select lastest post from database
    $query = "SELECT p.* ";
    $query .= ",u.username AS user_account_name ";
    $query .= ",u.picture AS user_account_picture ";

    $query .= ",IFNULL(SUM(v.up_count),0) AS votes_up ";
    $query .= ",IFNULL(SUM(v.down_count),0) AS votes_down ";

    $query .= "FROM post p ";
    $query .= "LEFT JOIN votes v ON v.post_id = p.id ";
    $query .= "LEFT JOIN user_account u ON u.id = p.user_account_id ";
    $query .= "WHERE p.id =:post_id ";
    $query .= "GROUP BY p.id ";
    $database->query($query);
    $database->bind(":post_id", (int)$lastInsertId);
    $postData = $database->resultSingle();
    if (!empty($postData)) {
        $postData['user_account_picture'] = ($postData['user_account_picture']) ? __ASSETS_IMG_API_URL.$postData['user_account_picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
    }

    $serverStatus = array('status' => 1, 'message' => 'Created post successfully');
} else {
    $serverStatus = array('status' => 0, 'message' => 'Someting went wrong. Please try again.');
}

echo json_encode(array('data' => $postData, 'server_status' => $serverStatus));

//close database connection
$database->closeConnection();