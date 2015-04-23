<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="title"><i class="fa fa-angle-double-right"></i> ',$title,'</div>
<div class="main-box">
<p class="red fs12" style="margin-left:60px;">';
if($options['authorized']){
    echo '<i class="fa fa-bullhorn"></i> 社区必须登录才能访问，请先登录！<br/>';
}
if($options['register_review']){
    echo $options['name'],' 已设置注册用户验证，注册后需要管理员审核！ <br/>';
}

foreach($errors as $error){
    echo '<br/><i class="fa fa-info-circle"></i> ',$error,' <br/>';
}

echo '</p>
<form action="',$_SERVER["REQUEST_URI"],'" method="post">
<input type="hidden" name="formhash" value="',$formhash,'" />
<p><label>用户名： <input type="text" name="name" class="sl w200" value="',htmlspecialchars($name),'" /></label></p>
<p><label>密　码： <input type="password" name="pw" class="sl w200" value="" /></label></p>';

if($url_path == 'sigin'){
    if($regip){
        echo '<p class="red">一个ip最小注册间隔时间是 ',$options['reg_ip_space'],' 秒，请稍后再来注册 或 让管理员把这个时间改小点。</p>';
    }else{
        echo '<p><label>重　复： <input type="password" name="pw2" class="sl w200" value="" /></label></p>';
        echo '<p><label>验证码： <input type="text" name="seccode" class="sl w100" value="" /></label> <img src="/seccode.php" align="absmiddle" /></p>';
    }
}else{
    echo '<p><label>验证码： <input type="text" name="seccode" class="sl w100" value="" /></label> <img src="/seccode.php" align="absmiddle" /></p>';
}

echo '<p><input type="submit" value=" 登 录 " name="submit" id="txtinbut" class="textbtn" /> </p>';
if($url_path == 'login'){
    if($options['close_register'] || $options['close']){
        echo '<p class="grey fs12"><i class="fa fa-diamond"></i> 社区实施邀请注册！&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-exclamation-triangle"></i> 忘记密码？<a href="/forgot">马上找回！</a>';
    }else{
        echo '<p class="grey fs12"><i class="fa fa-diamond"></i> 本站实施邀请注册！&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-exclamation-triangle"></i> 忘记密码？<a href="/forgot">马上找回！</a>';
    }
}else{
    echo '<p class="grey fs12">已有用户？<a href="/login">现在登录</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;忘记密码？<a href="/forgot">马上找回</a>';
}
echo '</p>
</form>
</div></div>';

?>
