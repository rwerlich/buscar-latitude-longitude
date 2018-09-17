<?php

namespace App\helpers;


class RequireValidator
{
    private $require;

    public function __construct(array $require)
    {
        $this->require = $require;
    }

    public function validate($data)
    {
        foreach ($this->require as $key => $value) {
            if (!array_key_exists($key, $data) || $data[$key] === '' || $data[$key] === null) {
                throw new \Exception('O campo '.$value.' é obrigátorio');
            }
        }
    }
}
