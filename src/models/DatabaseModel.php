<?php

namespace App\models;

class DatabaseModel
{

    protected $db = null;
    private $dbName = 'api_maps';
    private $host = 'localhost';
    private $user = 'root';
    private $passwaord = '';

    public function __construct()
    {
        if ($this->db === null) {
            $this->db =  new \PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->user, $this->passwaord, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
    }

}