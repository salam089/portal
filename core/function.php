<?php
/**
 * Created by PhpStorm.
 * User: S. M. Shah Alam
 * Date: 11/3/2016
 * Time: 4:26 PM
 */


/**
 * @return mixed
 */

// loading helper class

foreach (glob(PLUGIN_ROOT_DIR."/helper/*.php") as $filename)
{
    include_once $filename;
}

/**
 * return site url
 *
 */
function site_url(){
    return "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}

/**
 * @return mixed
 * Desc: get the calling class name
 */
function get_calling_class() {

    //get the trace
    $trace = debug_backtrace();
	
    // Get the class that is asking for who awoke it
    $class = $trace[1]['class'];

    // +1 to i cos we have to account for calling this function
    for ( $i=1; $i<count( $trace ); $i++ ) {
        if ( isset( $trace[$i] )  ) // is it set?
             if ( $class != @$trace[$i]['class'] ) // is it a different class
                 return @$trace[$i]['class'];
    }
}

// Calling function to pass unknown number of params
function get_method($object, $method){
    // used php lambda
    return function() use($object, $method){
        $args = func_get_args();
        return call_user_func_array(array($object, $method), $args);
    };
}

function generate_method_name($str){
    $strArr =array();
    $strArr = explode("_",$str);
    $method = "";
    foreach($strArr as $key => $val){
       $method .= ($key==0)? $val : ucfirst($val);
    }
    return $method;
}






