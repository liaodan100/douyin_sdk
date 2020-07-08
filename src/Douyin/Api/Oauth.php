<?php


namespace ByteDance\Douyin\Api;
use ByteDance\ApiExcepion;
use ByteDance\Douyin\Kernel\BaseApi;
use Curl\Curl;

class Oauth extends BaseApi
{
    public function connect()
    {
        $api_url = self::BASE_API . '/platform/oauth/connect/';
        $params = [
            'client_key'    => $this->client_key,
            'response_type' => 'code',
            'scope'         => '',
            'redirect_uri'  => '',

        ];

        try {
            $curl = new \Curl\Curl();
            $curl->get($api_url , $params);
            return $curl->response;
        }catch (ApiExcepion $e){
            return $e->getMessage();
        }
    }

    public function getAccessToken($code)
    {
        $api_url = self::BASE_API . '/oauth/access_token/';
        $params = [
            'client_key'    => $this->client_key,
            'client_secret' => $this->client_secret,
            'code'          => $code ,
            'grant_type'    => 'authorization_code'
        ];
    }
}