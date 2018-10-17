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

$threadData = [];

//get post data from client
$data = array(
    "subject" => Utility::filterPostString("_subject"),
    "content" => Utility::filterPostString("_content"),
    "created" => Utility::getDateNow(true),
    "user_account_id" => Utility::filterPostString("_user_account_id"),
);
//insert user data to database and get last user id
$lastInsertId = $database->insertHelper('threads', $data);

//get last thread data and respons to cilent
if ($lastInsertId) {
    //select lastest thread from database
    $query = "SELECT t.* ";
    $query .= ",u.username AS user_account_name ";
    $query .= ",u.picture AS user_account_picture ";
    $query .= ",IFNULL( ";
    $query .= "	( ";
    $query .= "		SELECT COUNT(threads_id) AS post_count ";
    $query .= "		FROM post";
    $query .= "		WHERE threads_id = t.id ";
    $query .= "	) ";
    $query .= ",0) AS post_count ";
    $query .= ",IFNULL(SUM(v.up_count),0) AS votes_up ";
    $query .= ",IFNULL(SUM(v.down_count),0) AS votes_down ";

    $query .= "FROM threads t ";
    $query .= "LEFT JOIN user_account u ON u.id = t.user_account_id ";
    $query .= "LEFT JOIN votes v ON v.threads_id = t.id ";
    $query .= "WHERE t.id =:thread_id ";
    $query .= "GROUP BY t.id ";
    $database->query($query);
    $database->bind(":thread_id", (int)$lastInsertId);
    $threadData = $database->resultSingle();
    if (!empty($threadData)) {
        $threadData['user_account_picture'] = ($threadData['user_account_picture']) ? __ASSETS_IMG_API_URL.$threadData['user_account_picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
    }

    $serverStatus = array('status' => 1, 'message' => 'Created thread successfully');
} else {
    $serverStatus = array('status' => 0, 'message' => 'Someting went wrong. Please try again.');
}

echo json_encode(array('data' => $threadData, 'server_status' => $serverStatus));

//close database connection
$database->closeConnection();