<?php
/**
 * Created by Shahalam.
 * User: S. M. Shah Alam
 * Date: 8/4/2016
 * Time: 3:43 PM
 */

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
function cmp_ajax_post_request(){

    include_once(PLUGIN_ROOT_DIR . 'core/loader.php');
    $error  = true;
    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    if(!empty($obj->operation->type)){
        $post = new PostHandaler($obj->operation);
        $request = get_method($post,'processRequest');
        $data = $request($obj);
    }
    if( ! empty( $data['error'] ) )
        return @json_encode(array('type'=>false,'data'=>$data, 'message'=> $data->message));
    if( ! empty( $data['success'] ) )
        return json_encode(array('type'=>true, 'data'=>$data, 'message'=>$data->message));
    die();
}

$partsA = explode("?", $_SERVER['REQUEST_URI']); // split querystring
$partsB = explode("/", $partsA[0]); // get url parts
if (count($partsB) < 2)
    die("missing controller in url");
elseif (count($partsB) < 3)
    die("missing action in url");
 $className = (isset($partsB[2])) ?$partsB[2]: false;
 $methodName = (isset($partsB[3])) ? $partsB[3] : false;

if($className =='ajax_post'){
    echo cmp_ajax_post_request();
    die();
}


















