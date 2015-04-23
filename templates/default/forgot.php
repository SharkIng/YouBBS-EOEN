<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="title"><i class="fa fa-angle-double-right"></i> 取回密码</div>
<div class="main-box">
<p class="red fs12" style="margin-left:60px;">';
echo '<i class="fa fa-bullhorn"></i> 请填写注册时提供的邮箱地址<br/>';
foreach($errors as $error){
    echo '<br/><i class="fa fa-info-circle"></i> ',$error,' ';
}
echo '</p>
<form action="',$_SERVER["REQUEST_URI"],'" method="post">
<p><label>用户名： <input type="text" name="name" class="sl w200" value="',htmlspecialchars($name),'" /></label></p>
<p><label>邮　箱： <input type="text" name="email" class="sl w200" value="" /></label></p>
<p><input type="submit" value=" 取回密码 " name="submit" class="textbtn" style="margin-left:70px;" /> </p>';
if($url_path == 'login'){
    if($options['close_register'] || $options['close']){
        echo '<p class="grey fs12">网站暂时关闭 或 已停止新用户注册';
    }else{
        echo '<p class="grey fs12">还没来过？<a href="/sigin">现在注册</a> ';
    }
}else{
    echo '<p class="grey fs12">哦~~又想起来了？！<a href="/login">现在登录</a> ';
}
echo '</p>
</form>
</div></div>';
echo '<div class="main-sider">
		<div class="sider-box">
			<div class="sider-box-title"><i class="fa fa-info-circle"></i> 密码找回</div>
			<div class="sider-box-content">
			<div class="reg">如果您注册时没有绑定邮箱请提供您的账号和您的推荐人信息发邮件至 pw@eoen.org 取回密码。我们可能会要求您提供您最近的发帖记录和登录区域信息！</div>
			</div>
			<div class="c"></div>
			</div>
		</div>
	  </div>';

?>
