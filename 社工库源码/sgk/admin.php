<?php

if(!defined('IN_TM')) 
{
exit('Access Denied');
}


?>

<?php require_once("header.php");?>
<script>
$(document).ready(function(){
  $("#reg").click(function(){
if ($("#name").val()==""){
     $.jBox.error('用户名没有填写哦~!', '<?php echo $config['name'];?>');
	 $("#name").focus();
	return false;
}
if ($("#pass").val()==""){
     $.jBox.error('密码没有填写哦~!', '<?php echo $config['name'];?>');
	 	 $("#pass").focus();
	 	return false;
}

$("#regact").submit();
  });
});
</script>

<form role="form" id="regact" method="post" action="index.php?act=icode_admin">
        <div class="form-group">
          <label for="name">管理员账号</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="您的用户名">
        </div>

        <div class="form-group">
          <label for="pass">管理员密码</label>
          <input type="password" class="form-control" name="pass" id="pass" placeholder="密码">
        </div>

	<input type="button" class="btn btn-default" name="reg" value="登录" id="reg">
      </form>
	  
	  <?php require_once("footer.php");?>