<?php
/**
 * Created by PhpStorm.
 * User: developers
 * Date: 2/10/2018
 * Time: 2:17 PM
 */

//show error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sitePath = realpath(dirname(__FILE__));
define ('__SITE_PATH', $sitePath);

//home page url
$_mainApiUrl = "http://192.168.7.183/grandats_project/forum/api/";
$_assetApiUrl = "http://192.168.7.183/grandats_project/forum/assets/";
define ('__MAIN_API_URL', $_mainApiUrl);
define ('__ASSETS_API_URL', $_assetApiUrl);
define ('__ASSETS_IMG_API_URL', $_assetApiUrl.'img/');

// page given in URL parameter, default page is one
$_page = isset($_GET['page']) ? $_GET['page'] : 1;
// set number of records per page
$_recordsPerPage = 10;
// calculate for the query LIMIT clause
$_startingPosition = ($_recordsPerPage * $_page) - $_recordsPerPage;

// include database and utility files
include_once $sitePath.'/shared/Database.php';
include_once $sitePath.'/shared/Utility.php';