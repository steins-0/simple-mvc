<?php

namespace app\core;

use ReflectionClass;

require_once('../config/config.php');

class DB
{
    public $dbCon;

    public function __construct()
    {
        $this->dbCon = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function get($tableName, $fields = ['*'])
    {
        $keys = implode(', ', $fields);
        $query = "SELECT $keys FROM $tableName";
        $stmt = $this->dbCon->query($query);

        $data = [];
        while ($row = mysqli_fetch_assoc($stmt)) {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Save the model in the database
     * @param Model $model
     * @return false|string
     * @throws \ReflectionException
     */
    public function save(Model $model)
    {
        $data = (array)$model;
        // Get the array keys
        $keys = array_keys($data);

        // Get the array values
        $values = array_values($data);

        // Get the table name
        $tableName = strtolower((new ReflectionClass($model))->getShortName()) . 's';

        $query = 'INSERT INTO ' . $tableName . ' (';
        foreach ($keys as $key) {
            $query .= $key . ', ';
        }

        $query = rtrim($query, ', ');
        $query .= ') VALUES (';

        foreach ($values as $value) {
            $query .= "'" . $value . "', ";
        }
        $query = rtrim($query, ', ');
        $query .= ')';

        $this->dbCon->query($query);

        return $model->__toString();
    }
}