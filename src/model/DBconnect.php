<?php

namespace App\model;

use PDO;

class DBconnect extends PDO
{
    protected $username;
    protected $password;
    protected $dns;

    public function __construct()
    {
        $this->username = 'root';
        $this->password = '123456@Abc';
        $this->dns = 'mysql:host=localhost;dbname=studentmanager';
    }

    public function connect()
    {
        $connect = new PDO($this->dns, $this->username, $this->password);
        return $connect;
    }
}