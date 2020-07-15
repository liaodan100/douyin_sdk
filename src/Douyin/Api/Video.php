<?php


namespace ByteDance\Douyin\Api;


use ByteDance\Douyin\Kernel\BaseApi;
use ByteDance\Douyin\Model\VideoDataBody;

class Video extends BaseApi
{
    public function video_data_api(array $videoDataBody , $openid , $access_token){
        $api = self::BASE_API . '/video/data/';
        $params = [
            'open_id'   => $openid,
            'access_token'  => $access_token
        ];
        $api = $api . '?' . http_build_query($params);

        return $this->https_post($api , $videoDataBody , true);

    }

    public function video_list_get(string $openid , string $access_token , int $pagesize , int $cursor = 0){
        $params = [
            'open_id'   => $openid ,
            'access_token'  => $access_token ,
            'count' => $pagesize ,
            'cursor'    => $cursor
        ];
        $url = self::BASE_API . '/video/list/' ;
        return  $this->https_get($url , $params);
        
    }
}