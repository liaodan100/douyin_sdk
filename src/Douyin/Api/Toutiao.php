<?php


namespace ByteDance\Douyin\Api;


use ByteDance\Douyin\Kernel\BaseApi;

class Toutiao extends BaseApi
{
    public function authorize(array $scope , string $redirect_url , $state =''){
        $api = self::BASE_TOUTIAO_API . '/oauth/authorize/';
        $params = [
            'client_key'    => $this->client_key,
            'response_type' => 'code',
            'scope' => implode(',' , $scope),
            'redirect_uri'  => $redirect_url,

        ];
        if($state != ''){
            $params['state'] = $state;
        }
        return $api . '?' . http_build_query($params);
    }

    public function access_token($code){
        $api = self::BASE_TOUTIAO_API . '/oauth/access_token/';
        $params = [
            'client_key'    => $this->client_key ,
            'client_secret' => $this->client_secret,
            'code'  => $code,
            'grant_type'    => 'authorization_code'
        ];
        return $this->https_get($api , $params);
    }

    public function refresh_token($refresh_token){
        $api = self::BASE_TOUTIAO_API . '/oauth/refresh_token/';
        $params = [
            'client_key'    => $this->client_key,
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refresh_token
        ];
        return $this->https_get($api , $params);
    }

    public function client_token(){
        $api_url = self::BASE_TOUTIAO_API . '/oauth/client_token/';
        $params = [
            'client_key'    => $this->client_key,
            'client_secret' => $this->client_secret,
            'grant_type'    => 'client_credential'
        ];
        return $this->https_get($api_url , $params);
    }
}