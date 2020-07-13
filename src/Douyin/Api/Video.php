<?php


namespace ByteDance\Douyin\Api;


use ByteDance\Douyin\Kernel\BaseApi;
use ByteDance\Douyin\Model\VideoDataBody;

class Video extends BaseApi
{
    public function video_data_api(VideoDataBody $videoDataBody , $openid , $access_token){
        $api = self::BASE_API . ' /video/data/';

        $params = [
            'body'  => $videoDataBody,
            'open_id'   => $openid,
            'access_token'  => $access_token
        ];

        return $this->https_post($api , $params);

    }
}