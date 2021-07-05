<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }
}