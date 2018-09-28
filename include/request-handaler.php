<?php
/**
 * Created by Shahalam.
 * User: S. M. Shah Alam
 * Date: 8/4/2016
 * Time: 3:43 PM
 */


function cmp_http_request(){

    include_once(PLUGIN_ROOT_DIR . 'core/loader.php');
    $error  = true;

    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if (!isset($obj))
        $obj = new stdClass();

        $obj->operation = new stdClass();
        $obj->operation->type = 'quotation_getTemplate';

    if(!empty($obj->operation->type)){
        $post = new PostHandaler($obj->operation);
        $request = get_method($post,'processRequest');
        $data = $request($obj);  //Output is "Hello"
    }

}




$partsA = explode("?", $_SERVER['REQUEST_URI']); // split querystring
$partsB = explode("/", $partsA[0]); // get url parts
if (count($partsB) < 2)
    die("missing controller in url");
elseif (count($partsB) < 3)
    die("missing action in url");
$className = (isset($partsB[2])) ?$partsB[2]: false;
$methodName = (isset($partsB[3])) ? $partsB[3] : false;

if($className !='ajax_post'){
    cmp_http_request();
    exit;
}















