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

//select post data from database
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
$database->bind(":post_id", (int)$postId);

$postData = $database->resultSingle();
if (!empty($postData)) {
    $postData['user_account_picture'] = ($postData['user_account_picture']) ? __ASSETS_IMG_API_URL.$postData['user_account_picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
}
echo json_encode(array('data' => $postData));

//close database connection
$database->closeConnection();