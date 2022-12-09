<?php

namespace app\libs;

use PDO;
use PDOException;

trait Create
{
    public function create($fieldsAndValues)
    {
        $placeholder = sprintf(
            "INSERT INTO %s (%s) VALUES (%s);",
            $this->table,
            implode(",", array_keys($fieldsAndValues)),
            ":" . implode(",:", array_keys($fieldsAndValues))
        );

        try {
            $query = $this->connection->prepare($placeholder);
            return $query->execute($fieldsAndValues); 
        } catch (PDOException $e) {
            throw $e;
        }
    }
}