<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<form action="',$_SERVER["REQUEST_URI"],'" method="post">
<input type="hidden" name="formhash" value="',$formhash,'" />
<div class="title">
    <i class="fa fa-angle-double-right"></i> ';
if($options['main_nodes']){
    echo '<select name="select_cid">';
    foreach($main_nodes_arr as $n_id=>$n_name){
        if($cid == $n_id){
            $sl_str = ' selected="selected"';
        }else{
            $sl_str = '';
        }
        echo '<option value="',$n_id,'"',$sl_str,'>',$n_name,'</option>';
    }
    echo '</select>';
}else{
    echo '    <a href="/n-',$c_obj['id'],'">',$c_obj['name'],'</a> (',$c_obj['articles'],')';
}
echo '
     <i class="fa fa-angle-double-right"></i> 创作新主题
</div>

<div class="main-box">';
if($tip){
    echo '<p class="red fs12"><i class="fa fa-info-circle"></i> ',$tip,'</p>';
}
echo '

<p>
<input type="text" name="title" value="',htmlspecialchars($p_title),'" class="sll" placeholder="请输入主题标题，如果标题能够表达完整内容，则正文可以为空"/>
</p>
<p><textarea id="id-content" name="content" class="mll tall">',htmlspecialchars($p_content),'</textarea></p>';
if(!$options['close_upload']){
    include(dirname(__FILE__) . '/upload.php');
}
echo '
<p><div class="float-right"><input type="submit" value=" 发布主题 " name="submit" class="textbtn" /></div><div class="c"></div></p>
</form>

</div>';


?>