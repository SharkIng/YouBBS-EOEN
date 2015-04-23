<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 
ob_start();

echo '<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<title>',$title,'</title>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<script src="',$options['jquery_lib'],'" type="text/javascript"></script>
<link href="/static/default/style.css" rel="stylesheet" type="text/css" />
<link href="/static/default/awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />';
if($options['head_meta']){
    echo $options['head_meta'];
}
if(isset($meta_des) && $meta_des){
    echo '
<meta name="description" content="',$meta_des,'" />';
}
if(isset($canonical)){
    echo '
<link rel="canonical" href="http://',$_SERVER['HTTP_HOST'],$canonical,'" />';
}
echo '
<script type="text/javascript">
		document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
</script>
</head>
<body>
<div class="header-wrap">
    <div class="header">
        <div class="logo"><a href="/" name="top">',htmlspecialchars($options['name']),'</a></div>';
echo '
        <div class="banner">';
        
if($cur_user){
    //echo '<img src="/avatar/mini/',$cur_user['avatar'],'.png" alt="',$cur_user['name'],'"/>&nbsp;&nbsp;&nbsp;';
    
    if(!$cur_user['password']){
        //echo '<a href="/setting#3" style="color:yellow;">设置登录密码</a>&nbsp;&nbsp;&nbsp;';
    }
    
    if($cur_user['notic']){
        $notic_n = count(array_unique(explode(',', $cur_user['notic'])))-1;
        //echo '<a href="/notifications" style="color:yellow;">',$notic_n,'条提醒</a>&nbsp;&nbsp;&nbsp;';
    }
    if($cur_user['flag'] == 0){
       // echo '<span style="color:yellow;">已被禁用</span>&nbsp;&nbsp;&nbsp;';
    }else if($cur_user['flag'] == 1){
       // echo '<span style="color:yellow;">在等待审核</span>&nbsp;&nbsp;&nbsp;';
    }
    echo '<a href="/"><i class="fa fa-home"></i>首页</a>
	      <a href="/favorites"><i class="fa fa-star"></i>收藏</a>
		  <a href="/setting"><i class="fa fa-cog"></i>设置</a>
		  <a id="translateLink"><i class="fa fa-language"></i>繁體</a>
		  <a href="/logout"><i class="fa fa-sign-out"></i>退出</a>';
}else{
    if($options['wb_key'] && $options['wb_secret']){
        //echo '<a href="/wblogin" rel="nofollow">微博登录</a>';
    }
    if($options['qq_appid'] && $options['qq_appkey']){
       // echo '<a href="/qqlogin" rel="nofollow">QQ登录</a>';
        
    }
    echo '<a id="translateLink"><i class="fa fa-language"></i>繁體</a>';
    if(!($options['wb_key'] && $options['wb_secret']) && !($options['qq_appid'] && $options['qq_appkey'])){
        if(!$options['close_register']){
            //echo '<a href="/sigin"><i class="fa fa-user-plus"></i>注册</a>';
        }
    }
}
echo '       </div>
        <div class="c"></div>
    </div>
</div>
<div class="main-wrap">
    <div class="main">
        <div class="main-content">';
include($pagefile);
echo '       </div>
        <!-- main-content end -->
        <div class="main-sider">';
include(dirname(__FILE__) . '/sider.php');
echo '       </div>
        <!-- main-sider end -->
        <div class="c"></div>
    </div>
    <!-- main end -->
    <div class="c"></div>
</div>';
echo '
<div class="footer-wrap">
    <div class="footer">
    <div class="sep10"></div>
	<div class="footer-logo"><img src="/static/images/secret.png"></div>
	<div class="sep10"></div><i class="fa fa-user-secret"></i> 私人专用网络分享社区<div class="sep5"></div>Lovingly made by <b>EOEN</b>';
if($options['show_debug']){
    $mtime = explode(' ', microtime());
    $totaltime = number_format(($mtime[1] + $mtime[0] - $starttime), 6);
    echo '<p>Processed in ',$totaltime,' second(s), ',$DBS->querycount,' queries</p>';
}
echo '</div>
</div>
<script src="/static/js/jquery.lazyload.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
$(function() {
    $(".main-box img").lazyload({
        //placeholder : "/static/grey.gif",
        //effect : "fadeIn"
    });
});
</script>
';
if($options['analytics_code']){
    echo $options['analytics_code'];
}

echo '<script src="/static/js/tw_cn.js" type="text/javascript"></script>
<script type="text/javascript">
translateInitilization();
</Script>
</body>
</html>';

$_output = ob_get_contents();
ob_end_clean();

// 304
if(!$options['show_debug']){
    $etag = md5($_output);
    if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag){
        header("HTTP/1.1 304 Not Modified");
        header("Status: 304 Not Modified");
        header("Etag: ".$etag);
        exit;    
    }else{
        header("Etag: ".$etag);
    }
}

echo $_output;

?>