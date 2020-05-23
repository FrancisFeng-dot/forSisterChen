<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:  
// +----------------------------------------------------------------------
use think\Request;
use think\View;
use think\Db;
use think\Session;


 function getwechatuserinfo($redirect_uri=null,$status=1,$scope = 'snsapi_userinfo'){
    $appid=config('wechat_appid');
    $secret=config('wechat_secret');
    $info = array();
    if(!$appid||!$secret||!$redirect_uri)return $info;
    
//如果存在session 返回用户信息即可；否则往下
    if(session('userinfo')){
        return session('userinfo');
    }

//如果没有带code，就直接出去拿code；
    if(!input('code')){
        header('Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3edf97fba911c055&redirect_uri='.$redirect_uri.'&response_type=code&scope='.$scope.'&state='.$status.'#wechat_redirect');   
        exit(); 
    }else{

        //通过code去拿access_token
        $code = input('code');
        $oauth2url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
        $jsoninfo = http_curl($oauth2url,null);
        $access_token = $jsoninfo['access_token'];
        $openid = $jsoninfo['openid'];


        //通过access_token 去拿用户信息；
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";      
        $jsoninfo = http_curl($url,null); 
        return $jsoninfo; 
    } 
 }