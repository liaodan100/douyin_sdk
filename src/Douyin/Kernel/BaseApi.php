<?php


namespace ByteDance\Douyin\Kernel;
use ByteDance\ApiExcepion;

/**
 * 内核
 * Class BaseApi
 * @package ByteDance\Douyin\Kernel
 */
class BaseApi
{
    const BASE_API = "https://open.douyin.com";
    public $client_key = null;
    public $client_secret = null;

    public function __construct($config)
    {
        $this->client_key = $config['client_key'];
        $this->client_secret = $config['client_secret'];
    }

    
}