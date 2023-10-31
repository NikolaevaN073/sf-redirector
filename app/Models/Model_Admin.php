<?php

use App\Core\Model;
use App\Core\DataBase;
use App\Core\Statistic;

class Model_Admin extends Model 
{    
    private $db;  
    public $user;
    public $data = [];  

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }
   
    public function get_data() 
    {   
        $data = $this->get_users(); 
        return $data;
    }   
    
    public function get_users () {

        $query = "SELECT users.id, name, login, password, status, role_name
        FROM users
        JOIN roles ON users.role_id = roles.id WHERE role_id <> ?
        GROUP BY users.id";

        return $this->db->get_data_fields($query, 3);
    }

    public function get_status ($id) 
    {
        $user_data = $this->db->get_data_row('users', 'id', $id);        
        
        if ($user_data['status'] === 'N') {
            return $this->anable($id);
        } elseif ($user_data['status'] === 'A') {
            return $this->disable($id);
        }
    }

    public function disable ($user_id)
    {        
        $query = "UPDATE users SET status = 'N' WHERE id = ?";
        $this->db->update_field($query, [$user_id]);        
        return 'N';
    }

    public function anable ($user_id)
    {        
        $query = "UPDATE users SET status = 'A' WHERE id = ?";
        $this->db->update_field($query, [$user_id]);        
        return 'A';
    }

    public function get_statistic (array $data)
    {
        $statistic = new Statistic($this->db, 
            $_COOKIE['user_id'], 
            '', 
            $data['daySystem'] ?? '', 
            $data['monthSystem'] ?? '', 
            $data['yearSystem'] ?? ''
        );
        $data = [];

        if ($statistic->day !== '') {
       
            $query_link = "SELECT COUNT(*) FROM subscriptions WHERE refer_url != ?";
            $data['links'] = $this->db->get_field($query_link, ['']);

            $query_clicks = "SELECT COUNT(*) FROM clicks WHERE clicks.status = 'success' AND date = ?";
            $data['clicks'] = $this->db->get_field($query_clicks, [$statistic->day]);

            $query_denial = "SELECT COUNT(*) FROM clicks WHERE clicks.status = 'denial' AND date = ?";
            $data['denial'] = $this->db->get_field($query_denial, [$statistic->day]);

            $query_profit = "SELECT SUM(price) FROM offers
                JOIN subscriptions ON offers.id = subscriptions.offer_id
                JOIN clicks ON subscriptions.id = clicks.subscription_id
                WHERE clicks.status = 'success' AND date = ?";
            $data['profit'] = number_format(round($this->db->get_field($query_profit, [$statistic->day])*0.2, 2), 2, '.', '');           
             
        }

        if ($statistic->month !== '' || $statistic->year !== '') {           

            $date = [];
            if ($statistic->month !== '') {
                $date = explode('/', $statistic->month);   
            }

            if ($statistic->year !== '') {
                $date = explode('/', $statistic->year); 
            }    

            $start = $date[0];
            $end = $date[1];             

            $query_link = "SELECT COUNT(*) FROM `subscriptions` WHERE refer_url != ?";
            $data['links'] = $this->db->get_field($query_link, ['']);

            $query_clicks = "SELECT COUNT(*) FROM clicks WHERE clicks.status = 'success' AND (date BETWEEN ? AND ?)";
            $data['clicks'] = $this->db->get_field($query_clicks, [$start, $end]);

            $query_denial = "SELECT COUNT(*) FROM clicks WHERE clicks.status = 'denial' AND (date BETWEEN ? AND ?)";
            $data['denial'] = $this->db->get_field($query_denial, [$start, $end]);

            $query_profit = "SELECT SUM(price) FROM offers
                JOIN subscriptions ON offers.id = subscriptions.offer_id
                JOIN clicks ON subscriptions.id = clicks.subscription_id
                WHERE clicks.status = 'success' AND (date BETWEEN ? AND ?)";
            $data['profit'] = number_format(round($this->db->get_field($query_profit, [$start, $end])*0.2, 2), 2, '.', '');   
        }                
        return $data;
    }
}
    