<?php

/**
 * Created by PhpStorm.
 * User: developers
 * Date: 2/10/2018
 * Time: 1:21 PM
 */
class Utility
{

    public static function getDateNow($includeTime = true){
        if ($includeTime ==false){
            return @date("Y-m-d");
        }else{
            return @date("Y-m-d H:i:s");
        }
    }
    public static function genHashPassword($passString){
        return hash('sha512', $passString);
    }
    public static function requiredJsonHeadersGet(){
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: access");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Credentials: true");
        header("Content-Type: application/json; charset=UTF-8");
    }
    public static function requiredJsonHeadersPost(){
        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }
    public static function getJsonData(){
        return json_decode(file_get_contents("php://input"));
    }
    public static function getRequestHeaders(){
        return apache_request_headers();
    }
    public static function getDefaultAvatar(){

        $list = array();
        $dir    = __SITE_PATH.'/assets/img/avatar';
        $avatarList = array_diff(scandir($dir), array('..', '.'));
        if(!empty($avatarList)){
            foreach ($avatarList AS $avatar){
                $ava['img_api_url'] = __ASSETS_IMG_API_URL.'avatar/'.$avatar;
                $ava['img_api_folder'] = 'avatar/'.$avatar;
                array_push($list, $ava);
            }
        }

        return $list;
    }

    /* Removes tags/special characters eg. html tags from a string and remove and replace unsafe charactor*/
    public static function filterGetString($var){
        return filter_input(INPUT_GET, $var, FILTER_SANITIZE_STRING);
    }
    public static function filterPostString($var){
        return filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
    }
}