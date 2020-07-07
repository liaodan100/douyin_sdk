<?php


class Test extends PHPUnit_Framework_TestCase
{
    public function t(){
        $class = new \ByteDance\Douyin\Douyin\Auth();
        var_dump($class->connect());
    }
}
