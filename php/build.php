<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 生成应用公共文件
    // '__file__' => ['common.php', 'config.php', 'database.php'],

    // 后台模块 
	
	// 前台模块
	'api'     => [
        '__file__'   => ['common.php', 'config.php'],
        '__dir__'    => [ 'controller', 'model', 'view'],
        'controller' => ['Auth','Base','Index','Init','Open'],
        'model'      => [],
        'view'       => ['index/index']
    ],
    // 用户中心模块
    // 'ucenter'     => [
    //     '__file__'   => ['common.php', 'config.php'],
    //     '__dir__'    => ['controller', 'model', 'view'],
    //     'controller' => ['Ucenter','Ucenterapi'],
    //     'model'      => [],
    //     'view'       => ['ucenter/index']
    // ],
    // // 用户中心模块
    // 'wap'     => [
    //     '__file__'   => ['common.php', 'config.php'],
    //     '__dir__'    => ['controller', 'model', 'view'],
    //     'controller' => ['Wap','Wapapi'],
    //     'model'      => [],
    //     'view'       => ['ucenter/index']
    // ]
    // 其他更多的模块定义
];
