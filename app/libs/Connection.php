<?php

namespace app\libs;

use app\models\Connection as Connect;

trait Connection
{
    protected $connection;   
    public function __construct() {
        $this->connection = Connect::connection();
    }
}