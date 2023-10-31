<?php

namespace App\Core;
use App\Core\DataBase;

class Statistic 
{
    protected $db;
    public $user_id;
    public $offer_id;
    public $day;
    public $month;
    public $year;

    public function __construct(DataBase $db, $user_id, $offer_id, $day, $month, $year)
    {
        $this->db = $db;
        $this->user_id = $user_id;
        $this->offer_id = $offer_id;
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;        
    }
    
    public function get_data ()
    {           
        //...       
    } 
}
