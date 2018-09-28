<?php

/**
 * Created by PhpStorm.
 * User: S. M. Shah Alam
 * Date: 11/3/2016
 * Time: 12:05 PM
 */
trait loader
{

    /**
     * @param $class_name
     * @return mixed
     */
    function load($class_name){
        global $classes;
        $file = $classes[$class_name];
        include_once($file);
        return new $class_name();

    }

    /**
     * @param $temp temaplate name
     * @param $args for using the processing data by controller to template
     *
     */
	function loadView($temp, $args){
		echo get_calling_class();
		include_once('View.php');
		 $view =  new View();
		 return $view->show($temp, $args);
	}

    function loadHelper($class_name){
        global $helper_classes;
        $file = $helper_classes[$class_name];
        include_once($file);
        return new $class_name();

    }


    /**
     * @param $class_name modela class name
     * @return mixed
     */
    function loadModel($class_name){
        global $cpi_modules;
        $module = ucfirst($class_name);
        $file = $cpi_modules[$module].CPI_MODEL.'/'.ucfirst($class_name).'.php';
        return include_once($file);
    }

    /**
     * @param $class_name controller class name
     * @return mixed
     * Desc: loading a controller
     */
    function loadController($class_name){
        global $cpi_modules;
        $module = ucfirst($class_name);
       $file = $cpi_modules[$module].CPI_CONTROLLER.'/'.ucfirst($class_name).'.php';
        return include_once($file);
    }

    /**
     * @param $class_name load library file
     * @return mixed
     */
    function loadLibrary($class_name){
        global $cpi_modules;
        $module = ucfirst($class_name);
        $file = PLUGIN_ROOT_DIR.'/libraries/'.ucfirst($class_name).'.php';
        return include_once($file);
    }


}