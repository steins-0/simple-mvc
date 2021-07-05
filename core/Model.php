<?php

namespace app\core;



class Model
{
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function __toString()
    {
        return json_encode($this);
    }
}