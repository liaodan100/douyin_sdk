## 字节跳动SDK

### 初始化 
```php
$app = \ByteDance\App::make('业务类', $config);
```

#### 业务类
- Douyin  抖音授权
- Toutiao 头条授权
- Video
- User

### 账号授权
```php
$app = \ByteDance\App::make('oauth', $config);
$app->drive('douyin')->connect($scope , $redirect_url , $state)->toArray();

```