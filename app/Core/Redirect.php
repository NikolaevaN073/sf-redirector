<?php

namespace App\Core;
use App\Core\DataBase;

class Redirect 
{
    protected $db;
    public $refer_url;
    public $customer_url;
    public $offer_id;
    public $user_id;

    public function __construct(DataBase $db, $refer_url, $customer_url, $offer_id, $user_id)
    {
        $this->db = $db;
        $this->refer_url = $refer_url;
        $this->customer_url = $customer_url;
        $this->offer_id = $offer_id;
        $this->user_id = $user_id;        
    }

    public function create_url ($id) 
    {
        return $this->refer_url = password_hash($id, PASSWORD_DEFAULT);
    }

    public function redirect ()
    {
        //...
    }
}
