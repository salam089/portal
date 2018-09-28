<?php

/**
 * Created by PhpStorm.
 * User: S. M. Shah Alam
 * Date: 10/31/2016
 * Time: 2:24 PM
 */
class PostHandaler
{
    public $db, $controller, $class, $module, $method;


    /**
     * PostHandaler constructor.
     * @param $data
     * Desc: When instance of PostHandaler is being created then some important public properties like db connection, controller, class, module method are assigned to public properties
     * so this properties will help to process request.
     */
    function __construct($data)
    {
        global $wpdb;
        global $cpi_modules;
        $this->db = $wpdb;
        $class = strtolower(strstr($data->type, '_', true));
        $this->class = $class;
        $this->module = $class;
        $this->method = str_ireplace($class.'_', '', $data->type);
        switch ($class) { // controller class
            case "quote":
                $this->controller = ucfirst('Quotation');
                $controller_file_path = $cpi_modules['Quotation'].CPI_CONTROLLER.'/'.$this->controller.'.php';
                include_once($controller_file_path);
                break;
            default: //
                 $this->controller = ucfirst($class);
                 $module_index = ucfirst($class);
                 $controller_file_path = $cpi_modules[$module_index].CPI_CONTROLLER.'/'.$this->controller.'.php';
                require_once($controller_file_path);
                break;
        }
        global $_POST;
        $post = $data;
        $_POST = (array)$post;

    }



    function getAll()
    {
        return $this->class . '--' . $this->controller;
    }


    public function processRequest(){

        $object = new $this->controller();
        $args = func_get_args();

        // get hetod data from
        $requested = @call_user_func_array(array($object, generate_method_name($this->method)), $args);

        if($requested){
            return $requested;
        }else{
            $data = array("details" => array('post'=>$_POST, 'module'=>$this->module, 'method'=>$this->method, 'args'=>$args, 'requested'=>$requested));
            $data['message'] = 'There is something going wrong try again with method: '.$this->method;
            $data['error'] = true;
            $data['success'] = false;
            return $data;
        }



    }



}