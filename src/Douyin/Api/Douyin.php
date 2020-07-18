<?php


namespace ByteDance\Douyin\Api;
use ByteDance\ApiExcepion;
use ByteDance\Douyin\Kernel\BaseApi;
use Curl\Curl;

class Douyin extends BaseApi
{
    public function connect(array $scope , string $redirect_url , string $state = '' )
    {
        $api_url = self::BASE_API . '/platform/oauth/connect/';
        $params = [
            'client_key'    => $this->client_key,
            'response_type' => 'code',
            'scope'         => implode(',' , $scope),
            'redirect_uri'  => $redirect_url,
        ];

        if($state){
            $params['state'] = $state;
        }

        return $api_url . '?' . http_build_query($params);

    }

    public function access_token($code)
    {
        $api_url = self::BASE_API . '/oauth/access_token/';
        $params = [
            'client_key'    => $this->client_key,
            'client_secret' => $this->client_secret,
            'code'          => $code ,
            'grant_type'    => 'authorization_code'
        ];

        return $this->https_get($api_url , $params);

    }

    /**
     * 刷新access_token或续期不会改变refresh_token的有效期
     * @param $refresh_token
     * @return Oauth
     */
    public function refresh_token(string $refresh_token){
        $api_url = self::BASE_API . '/oauth/refresh_token/';
        $params = [
            'client_key'   => $this->client_key,
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refresh_token
        ];
        return $this->https_get($api_url , $params);
    }

    /**
     * 刷新refresh_token
     * @param string $refresh_token
     * @return Oauth
     */
    public function renew_refresh_token(string $refresh_token){
        $api_url = self::BASE_API . '/oauth/renew_refresh_token/';
        $params = [
            'client_key'    => $this->client_key,
            'refresh_token' => $refresh_token
        ];
        return $this->https_get($api_url , $params);
    }

    public function client_token(){
        $api_url = self::BASE_API . '/oauth/client_token/';
        $params = [
            'client_key'    => $this->client_key,
            'client_secret' => $this->client_secret,
            'grant_type'    => 'client_credential'
        ];
        return $this->https_get($api_url , $params);
    }
}