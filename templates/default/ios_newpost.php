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
    echo '    <a href="/nodes/',$c_obj['id'],'">',$c_obj['name'],'</a> (',$c_obj['articles'],') ';
}
echo ' <i class="fa fa-angle-double-right"></i> 发新帖
</div>

<div class="main-box">';
if($tip){
    echo '<p class="red">',$tip,'</p>';
}
echo '
<p>
<input type="text" name="title" value="',htmlspecialchars($p_title),'" class="sll wb96" />
</p>
<p><textarea id="id-content" name="content" class="mll wb96 tall">',htmlspecialchars($p_content),'</textarea></p>
<p><input type="submit" value=" 发 表 " name="submit" class="textbtn wb96" /></p>
</form>
<div class="c"></div>
</div>';


?>