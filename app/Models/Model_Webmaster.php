<?php

use App\Core\Model;
use App\Core\DataBase;
use App\Core\Offer;
use App\Core\Redirect;
use App\Core\Statistic;

class Model_Webmaster extends Model 
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
        
        $query_all_offers = 
            "SELECT offers.id, offer_name, price, category_name
            FROM offers
            JOIN categories ON offers.category_id = categories.id 
            JOIN user_offer ON offers.id = user_offer.offer_id
            JOIN users ON users.id = user_offer.user_id
            WHERE users.role_id = 1 
            AND user_offer.offer_id NOT IN 
            (SELECT user_offer.offer_id FROM user_offer WHERE user_id = ?)
            AND offers.status = 'A' 
        ";
        
        $all_offers_data = $this->db->get_data_fields($query_all_offers, $_COOKIE['user_id']);       
        
        $all_offers = [];
        foreach ($all_offers_data as $offer) {
            
            $all_offers[] = [
                'id' => $offer['id'],
                'offer_name' => $offer['offer_name'],
                'price' => ($offer['price'])*0.8,
                'category_name' => $offer['category_name']
            ];
        } 
        $data['all_offers'] = $all_offers;

        $query_user_offers = "SELECT offers.id, offer_name, price, url, offers.status, category_name 
            FROM offers
            JOIN categories ON offers.category_id = categories.id        
            JOIN subscriptions ON offers.id = subscriptions.offer_id        
            JOIN user_offer ON offers.id = user_offer.offer_id
            WHERE user_id = ? AND subscriptions.status = 'A'";

        $user_offers_data = $this->db->get_data_fields($query_user_offers, $_COOKIE['user_id']);

        $user_offers = [];
        foreach ($user_offers_data as $offer) {
            $user_offers[] = [
                'id' => $offer['id'],
                'offer_name' => $offer['offer_name'],
                'price' => ($offer['price'])*0.8,
                'status' => $offer['status'],
                'category_name' => $offer['category_name']
            ];
        } 
        $data['user_offers'] = $user_offers;

        return $data;
    }      

    public function get_subscription ($id) 
    {        
        if (isset($_COOKIE['user_id'])) {            
            
            $query_sub = "SELECT subscriptions.id FROM subscriptions 
                WHERE offer_id = ? AND status = 'N'
            ";   
            $subscription_id = $this->db->get_field($query_sub, [$id]);         
            
            if ($subscription_id) {
                $query = "UPDATE subscriptions SET status = 'A' WHERE id = ?";
                $this->db->update_field ($query, [$subscription_id]);
            } else {
                $this->db->insert('subscriptions', [
                    'offer_id' => $id,
                    'status' => 'A'
                ]);
            }

            $this->db->insert('user_offer', [
                'user_id' => $_COOKIE['user_id'],
                'offer_id' => $id,
            ]);
                     
            
            $query_offer = "SELECT offer_name, price, category_name
            FROM offers
            JOIN categories ON categories.id = offers.category_id            
            WHERE offers.id = ?";

            $offer_data = $this->db->get_data_field($query_offer, [$id]);  

            return  [
                'id' => $id,
                'category' => $offer_data['category_name'],
                'offer_name' => $offer_data['offer_name'],
                'price' => ($offer_data['price'])*0.8
            ]; 
        }          
    }

    public function delete_subscription ($id) 
    {        
        if (isset($_COOKIE['user_id'])) {
            
            $subscription_data = "SELECT subscriptions.id FROM subscriptions 
                JOIN user_offer ON subscriptions.offer_id = user_offer.offer_id
                WHERE user_offer.user_id = ? AND user_offer.offer_id = ?";

            $subscription_id = $this->db->get_field($subscription_data, [$_COOKIE['user_id'], $id]);

            $query = "UPDATE subscriptions SET status = 'N' WHERE id = ?";
            $this->db->update_field ($query, [$subscription_id]);

            $delete = "DELETE FROM user_offer WHERE user_id = ? AND offer_id = ?"; 
            $this->db->delete($delete, [$_COOKIE['user_id'], $id]);
                        
            $query_offer = "SELECT offer_name, price, category_name
                FROM offers
                JOIN categories ON categories.id = offers.category_id
                WHERE offers.id = ?";

            $offer_data = $this->db->get_data_field($query_offer, [$id]);  

            return  [
                'id' => $id,
                'category' => $offer_data['category_name'],
                'offer_name' => $offer_data['offer_name'],
                'price' => ($offer_data['price'])*0.8
            ]; 
        }          
    }

    public function get_url ($offer_id, $user_id)
    {
        $offer_data = $this->db->get_data_row('offers', 'id', $offer_id);
        $offer = new Offer ($this->db, $offer_data['category_id'], $offer_data['offer_name'], $offer_data['price'], $offer_data['url']);
        $offer->id = $offer_id;

        if ($offer->check_status($offer->id)) {

            $subscription_data = $offer->get_subscription($offer->id, $user_id);

            if ($subscription_data['status'] === 'A') {

                $redirect = new Redirect($this->db, '', '', $offer->id, $user_id);

                $subscription_id = $subscription_data['id'];               
                
                if ($subscription_data['refer_url'] === '') {

                    $redirect->refer_url = $redirect->create_url($subscription_id); 
                    $query = "UPDATE subscriptions SET refer_url = ? WHERE id = ?";
                    $this->db->update_field($query, [$redirect->refer_url, $subscription_id]);
                
                } else {
                    $query = "SELECT refer_url FROM subscriptions WHERE id = ?";
                    $redirect->refer_url = $this->db->get_field($query, [$subscription_id]);
                }  

                return APP_URL . '/redirect?hash=' . $redirect->refer_url;
            }           
        }
    }

    public function get_statistic (array $data)
    {
        $statistic = new Statistic($this->db,
            $_COOKIE['user_id'], 
            $data['webmasterStatistic'], 
            $data['day'] ?? '', 
            $data['month'] ?? '', 
            $data['year'] ?? ''
        );
        $data = [];

        if ($statistic->day !== '') {

            $query = "SELECT COUNT(*) FROM clicks 
            JOIN subscriptions ON subscriptions.id = clicks.subscription_id
            JOIN (SELECT offer_id FROM user_offer WHERE user_id = ?) AS tmp
            ON tmp.offer_id = subscriptions.offer_id
            WHERE subscriptions.offer_id = ? AND clicks.status = 'success' AND date = ?";

            $data['count'] = $this->db->get_field($query, [ 
                $statistic->user_id, 
                $statistic->offer_id, 
                $statistic->day                
            ]);                       
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
            JOIN subscriptions ON subscriptions.id = clicks.subscription_id
            JOIN (SELECT offer_id FROM user_offer WHERE user_id = ?) AS tmp
            ON tmp.offer_id = subscriptions.offer_id
            WHERE subscriptions.offer_id = ? AND clicks.status = 'success' AND (date BETWEEN ? AND ?)";

            $data['count'] = $this->db->get_field($query, [$statistic->user_id, $statistic->offer_id, $start, $end]);             
        }
        $query_price = "SELECT price FROM offers WHERE offers.id = ?";
        $profit = (int)($this->db->get_field($query_price, [$statistic->offer_id]))*0.8;
                      
        $data['profit'] = number_format(round($data['count'] * $profit, 2), 2, '.', '');
        
        return $data;
    }
}
    