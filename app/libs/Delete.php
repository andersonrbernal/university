<?php

namespace app\libs;

use PDOException;

trait Delete 
{
    public function delete($field, $value)
    {
        try {
            $prepared = $this->connection->prepare("DELETE FROM {$this->table} WHERE {$field} = :{$field}");
            $prepared->bindValue($field, $value);
            return $prepared->execute();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}