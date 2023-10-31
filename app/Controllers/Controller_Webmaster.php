<?php

use App\Core\Controller;
use App\Core\DataBase;
use App\Core\View;

class Controller_Webmaster extends Controller 
{    
    protected $db;
    public $model;
	public $view;

    function __construct() 
    {
        $this->db = new DataBase;
        $this->model = new Model_Webmaster($this->db);
        $this->view = new View;   
    }

    public function action_index() 
    {     
        if (isset($_POST['offer_id_to_subscription'])) {
            $this->create($_POST['offer_id_to_subscription']);
        }

        if (isset($_POST['user_offer_id'])) {
            $this->delete($_POST['user_offer_id']);
        }

        if (isset($_POST['offer_id']) && isset($_POST['user_id'])) {
            $this->get_refer_url($_POST['offer_id'], $_POST['user_id']);
        }

        if (isset($_POST['webmasterStatistic'])) {
            $this->get_statistic_data($_POST);
        }

        $data = $this->model->get_data();       
        $this->view->generate('webmaster_view.php', 'template_view.php', $data);     
        exit();
    }

    public function create($id)
    {     
        echo json_encode($this->model->get_subscription($id), JSON_UNESCAPED_UNICODE);              
    }

    public function delete($id)
    {     
        echo json_encode($this->model->delete_subscription($id), JSON_UNESCAPED_UNICODE);              
    }
   
    public function get_refer_url($offer_id, $user_id)
    {
        echo json_encode($this->model->get_url($offer_id, $user_id));          
    }

    public function get_statistic_data(array $data)
    {
        echo json_encode($this->model->get_statistic($data));          
    }
}
