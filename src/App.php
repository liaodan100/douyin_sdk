<?php


namespace ByteDance;

class App
{
    public static function make($name , array $config)
    {
        $name = ucfirst(strtolower($name));
        $application = "\\ByteDance\\Douyin\\Api\\{$name}";

        return new $application($config);
    }

    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        return self::make($name , ...$arguments);
    }
}