<?php
/**
 * Created by PhpStorm.
 * User: S. M. Shah Alam
 * Date: 11/5/2016
 * Time: 3:49 PM
 */


global  $portal_controllers, $portal_models, $helper_classes;

$cpi_modules = array (
    'Quotation' => PLUGIN_ROOT_DIR.'module/quotation/',
    'Users' => PLUGIN_ROOT_DIR.'module/users/',
    'Login' => PLUGIN_ROOT_DIR.'module/login/'
);

$portal_controller = array (
    'Quotation' => '../module/quotation/controller/Quotation.php',
    'Users' => '../module/quotation/controller/Users.php',
    'Login' => '../module/quotation/controller/Login.php',
);
$portal_models = array (
    'Quotation' => '../module/quotation/model/Quotation.php',
    'Users' => '..module/quotation/model/Users.php',
    'Login' => '../module/quotation/model/Login.php',
);

$default_controller = ['controller'=> 'Quotation', 'method'=>'getTemplate'];

$helper_classes = array();

