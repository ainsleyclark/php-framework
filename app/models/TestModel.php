<?php

namespace app\models;

use Greg\Orm\Connection\ConnectionManager;
use Greg\Orm\Connection\MysqlConnection;
use Greg\Orm\Connection\Pdo;

class TestModel
{
    public function test()
    {
        $manager = new ConnectionManager();
        $manager->register('database', function() {
           return new MysqlConnection(new Pdo('mysql:dbname=fortyfive;host=192.168.10.10', 'homestead', 'secret'));
        });

        $manager->actAs('database');
        $users = $manager->select('*')->from('migrations')->fetchAll();

        var_dump($users);
            return 'IM IN THE MODEL';
    }
}