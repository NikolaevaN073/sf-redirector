<?php

use App\Core\Model;
use App\Core\DataBase;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Model_Redirect extends Model 
{    
    private $db;   

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }
   
    public function redirect ($hash) 
    {   
        // получаем строку из таблицы с данными о подписке, проверяем есть ли подписка (активна или нет) +
        $get_link = $this->db->get_data_row ('subscriptions', 'refer_url', $hash) ?? false;   
 
        if (isset($get_link) && $get_link['status'] === 'A') {                      
             
            //находим целевой url +
            $query = "SELECT url FROM offers WHERE id = ?";
            $customer_url = $this->db->get_field($query, [$get_link['offer_id']]);
             
            //перенаправляем клиента на целевой url и фиксируем факт перехода
            // записываем в бд - успех +
            $this->db->insert('clicks', [
                'subscription_id' => $get_link['id'],
                'date' => NOW(),
                'status' => 'success'
            ]);    
            
            //$log->info('success', ['subscription_id' => $get_link['id'], 'time' => date('H:i:s d.m.Y')]);
            
            header("Location:" . $customer_url); exit();
        } else {
            
            //записываем в бд - отказ +
            $this->db->insert('clicks', [
                'subscription_id' => $get_link['id'],
                'date' => NOW(),
                'status' => 'denial'
            ]);

            //$log->info('error', ['subscription_id' => $get_link['id'], 'time' => date('H:i:s d.m.Y')]);

            header("Location: /404"); exit();
        }
    }
}
