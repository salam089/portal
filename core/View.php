<?php

class View
{
    private $view_paths;

     function __construct()
    {
        
        $this->view_paths = [
            'views/',
           'module/'.strtolower(get_calling_class()).'/views/'
        ];
		
    }

    private function __clone()
    {
    }
    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    public function show($view, $vars = false)
    {
        //make sure there are no additional slashes or spaces in the view
        $view = trim($view,'/ ');
        if ($vars)
        {
            extract($vars);
        }
        $found = false;
		
        foreach($this->view_paths as $path)
        {
           $file = $path.$view.'.php';

            if(file_exists($file))
            {
                $found = true;
                include($file);
                break;
            }
        }

        if(!$found)
        {
            trigger_error('The requested view file "'.$view.'.php" was not found.');
        }
    }

    public function get($view, $vars)
    {
        //return the view as a string
        ob_start();
        $this->show($view, $vars);
        return ob_get_clean();
    }
}