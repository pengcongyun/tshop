<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'=>2,
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写

    //数据库
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'admin',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  't_',    // 数据库表前缀

    //默认访问
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称

    //配置模板引擎，给public下设置前缀，根目录
    'TMPL_PARSE_STRING'=>[
        '_CSS_'=>'/Public/css',
        '_JS_'=>'/Public/js',
        '_IMG_'=>'/Public/images',
        '_FONTS_'=>'/Public/fonts',
        '_LAYER_'=>'/Public/layer',
        '_UPLOADIFY_'=>'/Public/uploadify',
        '_UEDITOR_'=>'/Public/ueditor',
        '_ZTREE_'=>'/Public/ztree',
    ],

    //设置cookie前缀
    'COOKIE_PREFIX'=>'www_tshop_com_'
);