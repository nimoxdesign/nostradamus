<?php

namespace App\Decorator;

abstract class AbstractDecorator
{
    protected object $object;

    public function __construct(object $object)
    {
        $this->object = $object;
    }

    public function __call($method, $args)
    {
        if (method_exists($this->object, $method)) {
            return call_user_func_array([$this->object, $method], $args);
        }

        throw new \Exception(
            'Undefined method - ' . get_class($this->object) . '::' . $method
        );
    }
}
