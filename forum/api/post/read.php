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


//get thread id from client
$threadId = Utility::filterGetString("_thread_id");

//select all post in thread from database
$query = "SELECT p.* ";
$query .= ",u.username AS user_account_name ";
$query .= ",u.picture AS user_account_picture ";

$query .= ",IFNULL(SUM(v.up_count),0) AS votes_up ";
$query .= ",IFNULL(SUM(v.down_count),0) AS votes_down ";

$query .= "FROM post p ";
$query .= "LEFT JOIN votes v ON v.post_id = p.id ";
$query .= "LEFT JOIN user_account u ON u.id = p.user_account_id ";
$query .= "WHERE p.threads_id =:threads_id ";

$query .= "GROUP BY p.id ";
$query .= "ORDER BY p.id DESC ";
$query .= "LIMIT :starting_position , :records_per_page ";

$database->query($query);
$database->bind(":threads_id" , (int)$threadId);
$database->bind(":starting_position" , $_startingPosition);
$database->bind(":records_per_page" , $_recordsPerPage);

$postList = array();
$tmpPostList = $database->resultList();
if(!empty($tmpPostList)){
    foreach ($tmpPostList AS $tmpPost){
        $tmpPost['user_account_picture'] = ($tmpPost['user_account_picture']) ? __ASSETS_IMG_API_URL.$tmpPost['user_account_picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
        array_push($postList, $tmpPost);
    }
}
echo json_encode(array('data' => $postList));

//close database connection
$database->closeConnection();