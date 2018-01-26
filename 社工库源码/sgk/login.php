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

<!--<form role="form" id="regact" method="post" action="index.php?act=loginMethod">
        <div class="form-group">
          <label for="name">用户名</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="您的用户名">
        </div>

        <div class="form-group">
          <label for="pass">密码</label>
          <input type="password" class="form-control" name="pass" id="pass" placeholder="密码">
        </div>

	<input type="button" class="btn btn-default" name="reg" value="登录" id="reg">
      </form>-->
	  <form role="form" id="regact" method="post" action="index.php?act=loginMethod">
  <div class="qtitle">会员登录</div>
  <div class="form-group">
    <input type="text" class="form-control isicon" name="name" id="name" placeholder="您的用户名">
    <span class="user"></span>
  </div>
  <div class="form-group">
    <input type="password" class="form-control isicon" name="pass" id="pass" placeholder="密码">
    <span class="pass"></span>
  </div>
  <input type="button" class="btn btn-default" name="reg" value="登&nbsp;&nbsp;&nbsp;录" id="reg">
  <div class="formbg"></div>
</form>
	  
	  <?php require_once("footer.php");?>