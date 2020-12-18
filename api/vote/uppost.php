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

$postId = Utility::filterGetString("_post_id");
$userId = Utility::filterGetString("_user_account_id");

//find if this user already vote for this thread
$query = "SELECT * FROM votes WHERE post_id=:post_id_param AND user_account_id=:user_account_id_param";
$database->query($query);
$database->bind(":post_id_param", (int)$postId);
$database->bind(":user_account_id_param", (int)$userId);
$voteData = $database->resultSingle();

//if not exist just create new vote
if(empty($voteData)){
    $data = array(
        "up_count" => 1,
        "post_id" => $postId,
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

$serverStatus = array('status' =>1,'message'=> '');
echo json_encode(array('server_status'=>$serverStatus));