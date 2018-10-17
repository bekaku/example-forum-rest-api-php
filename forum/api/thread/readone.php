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
$database->bind(":thread_id", (int)$threadId);
$threadData = $database->resultSingle();
if (!empty($threadData)) {
    $threadData['user_account_picture'] = ($threadData['user_account_picture']) ? __ASSETS_IMG_API_URL.$threadData['user_account_picture'] : __ASSETS_IMG_API_URL.'no_picture.jpg' ;
}
echo json_encode(array('data' => $threadData));

//close database connection
$database->closeConnection();