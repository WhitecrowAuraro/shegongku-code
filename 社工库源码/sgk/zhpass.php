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
if ($("#mail").val()==""){
     $.jBox.error('邮箱没有填写哦~!', '<?php echo $config['name'];?>');
	 	return false;
}
if (!$("#mail").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) { 
     $.jBox.error('邮箱地址不正确~!', '<?php echo $config['name'];?>');
	 $("#mail").focus();
	 	return false;

}
$("#regact").submit();
  });
});
</script>

	 <form role="form" id="regact" method="post" action="index.php?act=zhpassMethod">
      <div class="qtitle">找回密码</div>
        <div class="form-group">
           <input type="text" class="form-control isicon" name="name" id="name" placeholder="您的用户名">
           <span class="user"></span>
        </div>
       <div class="form-group">
           <input type="email" class="form-control isicon" name="mail" id="mail"placeholder="您的邮箱">
           <span class="user"></span>
        </div>
  <input type="button" class="btn btn-default" name="reg" value="找&nbsp;&nbsp;&nbsp;回" id="reg">
  
  <div class="formbg"></div>
      </form>
	  
	  <?php require_once("footer.php");?>