<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>AdminX</title>

    <!--common-->
    <link href="/Public/css/style.css" rel="stylesheet">
    <link href="/Public/css/style-responsive.css" rel="stylesheet">

<!--引用百度地图API-->
<style type="text/css">
    html,body{margin:0;padding:0;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>

    <script src="/Public/js/html5shiv.js"></script>
<script src="/Public/js/respond.min.js"></script>
<![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="/Public/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="/Public/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">

                <!--<?php if(is_array($nav_menus)): foreach($nav_menus as $key=>$top_nav): ?>-->
                <!--<?php if(($top_nav["level"]) == "1"): ?>-->
                <!--<li class="menu-list"><a href=""> <span><?php echo ($top_nav["name"]); ?></span></a>-->
                <!--<ul class="sub-menu-list">-->
                <!--<?php if(is_array($nav_menus)): foreach($nav_menus as $key=>$sub_nav): ?>-->
                <!--<?php if(($sub_nav["parent_id"]) == $top_nav["id"]): ?>-->
                <!--<li><a href="<?php echo U($sub_nav['path']);?>"> <?php echo ($sub_nav["name"]); ?></a></li>-->
                <!--<?php endif; ?>-->
                <!--<?php endforeach; endif; ?>-->
                <!--</ul>-->
                <!--</li>-->
                <!--<?php endif; ?>-->
                <!--<?php endforeach; endif; ?>-->

                <li class="active"><a href="<?php echo U('Index/index');?>"><i class="fa fa-home"></i> <span>管理首页</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-laptop"></i> <span>商品管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="lists.html"> 供应商管理</a></li>
                        <li><a href="<?php echo U('Brand/index');?>"> 品牌管理</a></li>
                        <li><a href="<?php echo U('GoodsCategory/index');?>"> 商品分类管理</a></li>
                        <li><a href="<?php echo U('Goods/index');?>"> 商品列表</a></li>

                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-book"></i> <span>订单管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('Order/index');?>"> 订单列表</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-cogs"></i> <span>会员管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('');?>"> 会员列表</a></li>

                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-envelope"></i> <span>文章管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('Articlecategory/index');?>"> 文章分类管理</a></li>
                        <li><a href="<?php echo U('Article/index');?>"> 文章列表</a></li>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-tasks"></i> <span>系统设置</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="form_layouts.html"> 网站基本设置</a></li>
                        <li><a href="form_advanced_components.html"> 支付管理</a></li>
                        <li><a href="form_wizard.html"> 活动管理</a></li>
                    </ul>
                </li>
                <li class="menu-list"><a href=""><i class="fa fa-tasks"></i> <span>权限管理</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo U('Permission/index');?>"> 权限列表</a></li>
                        <li><a href="<?php echo U('Role/index');?>"> 角色列表</a></li>
                        <li><a href="<?php echo U('Admin/index');?>"> 管理员管理</a></li>
                        <li><a href="<?php echo U('Menu/index');?>"> 菜单管理</a></li>
                    </ul>
                </li>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        <div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
            <form class="searchform" action="index.html" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="搜索" />
            </form>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="/Public/images/photos/user-avatar.png" alt="" />
                            kunx
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  个人资料</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>  修改密码</a></li>
                            <li><a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out"></i> 退出</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--notification menu end -->

        </div>
        <!-- header section end-->
        <div class="page-heading">
            <h3>
                <?php echo ($title["b_title"]); ?>
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#"><?php echo ($title["m_title"]); ?></a>
                </li>
                <li class="active"> <?php echo ($title["s_title"]); ?> </li>
            </ul>
        </div>
    <!-- page heading start-->

    <!-- page heading end-->
        <!-- page heading start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">

                    <div class="panel-body">
                        <div class="adv-table">

                            <!--百度地图容器-->
                            <div style="width:1400px;height:1100px;border:#ccc solid 1px;" id="dituContent"></div>

                            <script type="text/javascript">
                                //创建和初始化地图函数：
                                function initMap(){
                                    createMap();//创建地图
                                    setMapEvent();//设置地图事件
                                    addMapControl();//向地图添加控件
                                }

                                //创建地图函数：
                                function createMap(){
                                    var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                                    var point = new BMap.Point(104.071216,30.576279);//定义一个中心点坐标
                                    map.centerAndZoom(point,12);//设定地图的中心点和坐标并将地图显示在地图容器中
                                    window.map = map;//将map变量存储在全局
                                }

                                //地图事件设置函数：
                                function setMapEvent(){
                                    map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                                    /*map.enableScrollWheelZoom();//启用地图滚轮放大缩小*/
                                    map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                                    map.enableKeyboard();//启用键盘上下左右键移动地图
                                }

                                //地图控件添加函数：
                                function addMapControl(){
                                    //向地图中添加缩放控件
                                    var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
                                    map.addControl(ctrl_nav);
                                    //向地图中添加缩略图控件
                                    var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
                                    map.addControl(ctrl_ove);
                                    //向地图中添加比例尺控件
                                    var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
                                    map.addControl(ctrl_sca);
                                }


                                initMap();//创建和初始化地图
                            </script>

<!--footer section start-->
<footer>
    2014 &copy; AdminEx by ThemeBucket
</footer>

<!--footer section end-->


</div>
<!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="/Public/js/jquery-1.10.2.min.js"></script>
<script src="/Public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/Public/js/bootstrap.min.js"></script>
<script src="/Public/js/jquery.nicescroll.js"></script>

<!--<script src="/Public/uploadify/jquery.uploadify.min.js"></script>
<script src="/Public/layer/layer.js"></script>-->

<!--common scripts for all pages-->
<script src="/Public/js/scripts.js"></script>



</body>
</html>