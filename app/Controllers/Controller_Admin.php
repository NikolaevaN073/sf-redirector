<?php

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\View;

class Controller_Admin extends Controller 
{    
    protected $db;
    public $model;
	public $view;

    function __construct() 
    {
        $this->db = new DataBase;
        $this->model = new Model_Admin($this->db);
        $this->view = new View;            
    }

    public function action_index() 
    {         
        if (isset($_POST['user_id'])) {
            $this->change_status($_POST['user_id']);
        }

        if (isset($_POST['daySystem'])) {
            $this->get_statistic_data($_POST);
        }

        $data = $this->model->get_data();       
        $this->view->generate('admin_view.php', 'template_view.php', $data);     
        exit();
    }
    
    public function change_status($id)
    {
        echo json_encode($this->model->get_status($id));          
    }

    public function get_statistic_data(array $data)
    {
        echo json_encode($this->model->get_statistic($data));          
    }    
}
