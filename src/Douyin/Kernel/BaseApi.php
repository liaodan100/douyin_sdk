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
    const BASE_TOUTIAO_API = "https://open.snssdk.com";
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
//        $curl = new Curl();
//        $this->response = $curl->get($url , $params)->response;
        if($params){
            $url = $url . '?' . http_build_query($params);
        }
        $this->response = $this->https_request($url );
        return $this;
    }

    public function https_post($url, $data = [] , $is_raw = false){
//        $curl = new Curl();
//        $this->response = $curl->post($url , $data , $is_raw)
//            ->setHeader('X-Requested-With', 'XMLHttpRequest')
//            ->setHeader("Accept" , 'application/json')
//            ->setHeader('Content-Type' , 'application/json')
//            //->setOpt(CURLOPT_PROXY , '127.0.0.1:8888')
//            ->response;

        $header = [
            'Accept:application/json' , 'Content-Type:application/json'
        ];
        $this->response = $this->https_request($url , json_encode($data ) , $header);

        return $this;
    }

    public function https_request($url, $data = null , $headers = null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        if(!empty($headers)){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        //设置curl默认访问为IPv4
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        return ($output);
    }

}