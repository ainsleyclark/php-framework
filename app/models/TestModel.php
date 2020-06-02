<?php

namespace app\models;

use app\core\DB;

class TestModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB('mysql');
    }

    public function test()
    {
        $data = $this->db->table('users')->select('*')->get();

        return $data;
    }
}