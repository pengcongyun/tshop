<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'=>2,
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写

    //数据库
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'tshop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
//    'DB_PREFIX'             =>  't_',    // 数据库表前缀

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

    'URL_ROUTER_ON'=>true,//开启路由
    'URL_ROUTE_RULES'=>array(//定义路由规则
        'Goodlist'=>'Admin/Good/index',
    ),


    //设置cookie前缀
    'COOKIE_PREFIX'=>'www_tshop_com_',
    'UPLOAD_SETTING'=>[
        'URL_PREFIX'=>'http://www.tshop.com/',
        'SETTING'=>array(
            'mimes'         =>  array('image/jpeg','image/png','image/gif'), //允许上传的文件MiMe类型
            'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','png','gif','jpeg'), //允许上传的文件后缀
            'autoSub'       =>  true, //自动子目录保存文件
            'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath'      =>  './', //保存根路径
            'savePath'      =>  'Upload/', //保存路径
            'saveName'      =>  array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
            'saveExt'       =>  '', //文件保存后缀，空则使用原后缀
            'replace'       =>  false, //存在同名是否覆盖
            'hash'          =>  true, //是否生成hash编码
            'callback'      =>  false, //检测文件是否存在回调，如果存在返回文件信息数组

            'fsizeLimit'=>'',           //限制上传图片的大小 5G
//            没有七牛云配置，上传到本地
//            'driver'        =>  'Qiniu', // 文件上传驱动
//            'driverConfig'  =>  array(
//                'secretKey' => 'VQnadNo_J--Mgxyd0-r93ma6p_PMwB_Azfx0Wm01', //七牛密码
//                'accessKey' => 'Oole_2ThnqAKgDpXCF_PTeM8DgFId6qMOMWA65B_', //七牛用户
//                'domain'    => 'oieqmofwy.bkt.clouddn.com', //七牛服务器
//                'bucket'    => 'pengcongyun', //空间名称
//                'timeout'   => 300, //超时时间
//            ), // 上传驱动配置
        ),
    ],

);