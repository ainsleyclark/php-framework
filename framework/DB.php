<?php

namespace app\core;

class DB
{

    protected $database;
    protected $table;
    protected $select = '*';
    protected $join;

    /**
     * DB constructor.
     * @param bool $driver
     */
    public function __construct($driver = false)
    {
        if(!$driver){
            error('Please specify a database driver');
        }

        $this->init($driver);
    }

    /**
     * @param $driver
     */
    private function init($driver)
    {
        $dbConf = getConf('database')[$driver];

        if($dbConf == null) {
            error('Database driver "' . $driver . '" does not exist in your database.php config file');
        }

        switch ($driver) {
            case 'mysql':
                $this->database = new \mysqli($dbConf['host'], $dbConf['username'], $dbConf['password'], $dbConf['database']);

                if ($this->database->connect_error) {
                    error('Could not connect to database with credentials in database.php config file', $this->database->connect_error);
                }
                break;
            default:
                error('We do not yet support this database connection type');
        }

    }

    /**
     * @param bool $tableName
     * @return $this
     */
    public function table($tableName = false)
    {
        if (!$tableName){
            error('You must specify a table name');
        }

        $this->table = $tableName;
        return $this;
    }

    /**
     * build selects
     */
    public function select()
    {
        $args = func_get_args();

        $selects = '';
        foreach ($args as $arg){
            $selects .= $arg;
        }

        if ($selects == ''){
            $selects = '*';
        }

        $this->select = $selects;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $query = 'SELECT ' . $this->select . ' FROM ' . $this->table;
        $query = $this->database->query($query);

        $data = $query->fetch_all();

        $query->close();

        return $data;
    }
}