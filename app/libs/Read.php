<?php

namespace app\libs;

use PDOException;

trait Read
{
    public function find(bool $fetchAll = true) 
    {
        try {
            $query = $this->connection->query("SELECT * FROM {$this->table}");
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function findBy($field, $value, bool $fetchAll = true)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE $field = :{$field}";
            $prepared = $this->connection->prepare($query);
            $prepared->bindValue(":{$field}", $value);
            $prepared->execute();
            return $fetchAll ? $prepared->fetchAll() : $prepared->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function findLastId($field)
    {
        try {
            $query = $this->connection->query("SELECT max($field) AS $field FROM {$this->table}");
            $data = $query->fetch();
            return $data[$field];
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}