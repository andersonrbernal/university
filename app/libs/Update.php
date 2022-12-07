<?php

namespace app\libs;

use PDOException;

trait Update
{
    public function update(array $fieldsAndValues)
    {
        $fields = $fieldsAndValues['fields'];
        $where = $fieldsAndValues['where'];
        $updateFields = '';

        foreach (array_keys($fields) as $field) {
            $updateFields .= "$field = :{$field},";
        }
        $updateFields = rtrim($updateFields, ',');
        $whereUpdate = array_keys($where);
        $bind = array_merge($fields, $where);
        $query = sprintf(
            "UPDATE %s SET %s WHERE %s",
            $this->table,
            $updateFields, 
            "$whereUpdate[0] = :{$whereUpdate[0]}"
        );

        try {
            $prepare = $this->connection->prepare($query);
            return $prepare->execute($bind);
        } catch (PDOException $e) {
            throw $e;
        }
    }
}