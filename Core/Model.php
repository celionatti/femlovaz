<?php

namespace App\Core;

class Model
{
    protected $allowedProperties = [];
    protected $data = [];

    public function setData($data) {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->allowedProperties)) {
                $this->data[$key] = $value;
            }
        }
    }

    public function getData($property = null) {
        if ($property === null) {
            return $this->data;
        } elseif (array_key_exists($property, $this->data)) {
            return $this->data[$property];
        } else {
            return null; // or throw an exception
        }
    }
    
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}