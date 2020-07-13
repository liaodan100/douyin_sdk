<?php


namespace ByteDance\Douyin\Api;

use ByteDance\Douyin\Kernel\BaseApi;
use Curl\Curl;

class User extends  BaseApi
{
    /**
     * 获取用户信息
     * @param string $access_token
     * @param string $openid
     * @return User
     */
    public function userinfo($access_token , $openid){
        $api_url = self::BASE_API . '/oauth/userinfo/';

        $params = [
            'access_token'  => $access_token,
            'open_id'       => $openid
        ];

        return $this->https_get($api_url , $params);
    }

    /**
     * 获取粉丝列表
     * @param string $openid
     * @param string $access_token
     * @param string $pagesize
     * @param string $offset
     * @return User
     */
    public function fans($openid , $access_token , $pagesize , $offset){
        $api_url = self::BASE_API . '/fans/list/';
        return $this->https_get($api_url , [
            'open_id'   => $openid,
            'access_token'  => $access_token ,
            'count'         => $pagesize,
            'cursor'        => $offset
        ]);
    }
}