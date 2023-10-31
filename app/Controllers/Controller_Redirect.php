<?php

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\View;

class Controller_Redirect extends Controller 
{       
    protected $db;
    public $model;
	public $view;

    public function __construct() 
    {
        $this->db = new DataBase;
        $this->model = new Model_Redirect($this->db);
        $this->view = new View();
    }

    public function action_index() 
    {                  
        if (isset($_GET['hash'])) {
            $this->model->redirect($_GET['hash']);  
            var_dump($_GET);           
        } 
        $this->view->generate('redirect_view.php', 'template_view.php');         
    }
}   
