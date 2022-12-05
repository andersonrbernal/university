<?php

namespace app\libs;

use PDOException;

trait Read
{
    public function find($fetchAll = true) 
    {
        try {
            $query = $this->connection->query("SELECT * FROM {$this->table}");
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}