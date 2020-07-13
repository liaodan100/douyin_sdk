<?php


namespace ByteDance\Douyin\Kernel;
use ByteDance\ApiExcepion;
use Curl\Curl;

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

    public $response = null;

    public function __construct($config)
    {
        $this->client_key = $config['client_key'];
        $this->client_secret = $config['client_secret'];
    }

    public function toArray(){
        return $this->response ?  json_decode($this->response , true) : true;
    }

    public function https_get($url , $params = []){
        $curl = new Curl();
        $curl->get($url , $params);
        $this->response = $curl->response;
        return $this;
    }

    public function https_post($url, $data = []){
        $curl = new Curl();
        $curl->post($url , $data);
        $this->response = $curl->response;
        return $this;
    }

}