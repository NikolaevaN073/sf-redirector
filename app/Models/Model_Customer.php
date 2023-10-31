<?php

use App\Core\Model;
use App\Core\DataBase;
use App\Core\Offer;
use App\Core\Statistic;

class Model_Customer extends Model 
{
    private $db;  
    public $offer;
    public $data = [];  

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }
   
    public function get_data() 
    {   
        $data['status'] = $this->db->get_data_row('users', 'id', $_COOKIE['user_id'])['status'];
        $data['categories'] = $this->db->get_data('categories');
        
        $query = "SELECT offers.id, offers.status, offer_name, price, url, IFNULL(COUNT(subscriptions.id), 0) AS count_of_a
        FROM offers
        LEFT JOIN user_offer ON offers.id = user_offer.offer_id
        LEFT JOIN subscriptions ON offers.id = subscriptions.offer_id AND subscriptions.status = 'A'
        WHERE user_offer.user_id = ?
        GROUP BY offers.id;";

        $data['offers'] =  $this->db->get_data_fields($query, $_COOKIE['user_id']);        
 
        return $data;
    }   
    
    public function create_offer(array $data)
    {
        if (isset($_COOKIE['user_id'])) {
            $category_id = $data['category_id'];
            $offer_name = $data['offer_name'];
            $price = $data['price'];
            $url = $data['url'];

            $offer = new Offer($this->db, $category_id, $offer_name, $price, $url);
            return $offer->create();
        }           
    }   

    public function get_status ($id) 
    {
        $offer_data = $this->db->get_data_row('offers', 'id', $id);
        
        $offer = new Offer($this->db, $offer_data['id'], $offer_data['offer_name'], $offer_data['price'], $offer_data['url']);
        if ($offer_data['status'] === 'N') {
            return $offer->anable($id);
        } elseif ($offer_data['status'] === 'A') {
            return $offer->disable($id);
        }
    }

    public function get_statistic (array $data)
    {
        $statistic = new Statistic($this->db, $_COOKIE['user_id'], $data['customerStatistic'], $data['day'] ?? '', $data['month'] ?? '', $data['year'] ?? '');
        $data = [];

        if ($statistic->day !== '') {

            $query = "SELECT COUNT(*) FROM clicks 
            JOIN subscriptions ON clicks.subscription_id = subscriptions.id
            WHERE offer_id = ? AND clicks.status = 'success' AND date = ?";

            $data['count'] = $this->db->get_field($query, [$statistic->offer_id, $statistic->day]);
                       
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
         
            $query = "SELECT COUNT(*) FROM clicks 
            JOIN subscriptions ON clicks.subscription_id = subscriptions.id
            WHERE offer_id = ? AND clicks.status = 'success' AND (date BETWEEN ? AND ?)";

            $data['count'] = $this->db->get_field($query, [$statistic->offer_id, $start, $end]);             
        }
        $query_price = "SELECT price FROM offers WHERE offers.id = ?";
        $cost = (int)($this->db->get_field($query_price, [$statistic->offer_id]));
                      
        $data['cost'] = number_format(round($data['count'] * $cost, 2), 2, '.', '');        
        return $data;
    }
}
    