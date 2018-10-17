<?php
/**
 * Created by PhpStorm.
 * User: developers
 * Date: 3/10/2018
 * Time: 3:27 PM
 */
include_once '../../core.php';
Utility::requiredJsonHeadersGet();

// instantiate database
$database = new Database();
//open connection to database
$database->getConnection();

$threadId = Utility::filterGetString("_thread_id");
$userId = Utility::filterGetString("_user_account_id");

//find if this user already vote for this thread
$query = "SELECT * FROM votes WHERE threads_id=:threads_id_param AND user_account_id=:user_account_id_param";
$database->query($query);
$database->bind(":threads_id_param", (int)$threadId);
$database->bind(":user_account_id_param", (int)$userId);
$voteData = $database->resultSingle();

//if not exist just create new vote
if(empty($voteData)){
    $data = array(
        "up_count" => 1,
        "threads_id" => $threadId,
        "user_account_id" =>$userId,
    );
    $database->insertHelper('votes', $data);
}else{
    //if exist just update it to deposite vote
    $updateData['down_count'] = 0;
    if($voteData['up_count']==1){
        $updateData['up_count'] = 0;
    }else{
        $updateData['up_count'] = 1;
    }
    $database->updateHelper('votes',$updateData, array('id'=>$voteData['id']));
}

//return lastest count to client
$query = "SELECT  ";
$query .= "IFNULL( ";
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

$serverStatus = array('status' =>1,'message'=> '');
echo json_encode(array(
    'data' => $threadData,
    'server_status'=>$serverStatus));