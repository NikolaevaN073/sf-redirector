<?php

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\View;

class Controller_Customer extends Controller 
{    
    protected $db;
    public $model;
	public $view;

    function __construct() 
    {
        $this->db = new DataBase;
        $this->model = new Model_Customer($this->db);
        $this->view = new View; 
    }

    public function action_index() 
    {         
        if (isset($_POST['offer_name'])) {            
            $this->create($_POST);
        } 

        if (isset($_POST['id'])) {
            $this->change_status($_POST['id']);
        }

        if (isset($_POST['customerStatistic'])) {
            $this->get_statistic_data($_POST);
        }

        $data = $this->model->get_data();       
        $this->view->generate('customer_view.php', 'template_view.php', $data);     
        exit();
    }
    
    public function create($data)
    {     
        echo json_encode($this->model->create_offer($data), JSON_UNESCAPED_UNICODE);              
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
