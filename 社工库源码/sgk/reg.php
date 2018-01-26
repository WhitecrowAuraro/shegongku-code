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
if ($("#pass").val()==""){
     $.jBox.error('密码没有填写哦~!', '<?php echo $config['name'];?>');
	 	 $("#pass").focus();
	 	return false;
}
if ($("#passcache").val()==""){
     $.jBox.error('重复密码没有填写哦~!', '<?php echo $config['name'];?>');
	 	 	 $("#passcache").focus();
	 	return false;
}
if ($("#passcache").val()!=$("#pass").val()){
     $.jBox.error('两次密码确定一样吗?', '<?php echo $config['name'];?>');
	 	return false;

}
if ($("#icode").val()==""){
     $.jBox.error('邀请码没有填写哦~!', '<?php echo $config['name'];?>');
	 	 	 	 $("#icode").focus();
	 	 	return false;
}
$("#regact").submit();
  });
});
</script>

<!--<form role="form" id="regact" method="post" action="index.php?act=regMethod">
        <div class="form-group">
          <label for="name">用户名</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="您的用户名">
        </div>
		   <div class="form-group">
          <label for="mail">邮箱</label>
          <input type="email" class="form-control" name="mail" id="mail"placeholder="您的邮箱">
        </div>
        <div class="form-group">
          <label for="pass">密码</label>
          <input type="password" class="form-control" name="pass" id="pass" placeholder="密码">
        </div>
         <div class="form-group">
          <label for="passcache">重复输入一遍密码</label>
          <input type="password" class="form-control" name="passcache" id="passcache" placeholder="重复输入一遍密码">
        </div>
		     <div class="form-group">
          <label for="icode">邀请码</label>
          <input type="password" class="form-control" name="icode" id="icode" placeholder="邀请码">
        </div>
	<input type="button" class="btn btn-default" name="reg" value="注册" id="reg">
      </form>-->
	 <form role="form" id="regact" method="post" action="index.php?act=regMethod">
      <div class="qtitle">会员注册</div>
        <div class="form-group">
           <input type="text" class="form-control isicon" name="name" id="name" placeholder="您的用户名">
           <span class="user"></span>
        </div>
       <div class="form-group">
           <input type="email" class="form-control isicon" name="mail" id="mail"placeholder="您的邮箱">
           <span class="user"></span>
        </div>
        <div class="form-group">
           <input type="password" class="form-control isicon" name="pass" id="pass" placeholder="密码">
           <span class="pass"></span>
        </div>
         <div class="form-group">
           <input type="password" class="form-control isicon" name="passcache" id="passcache" placeholder="重复输入一遍密码">
           <span class="pass"></span>
        </div>
         <div class="form-group">
           <input type="password" class="form-control isicon" name="icode" id="icode" placeholder="邀请码">
           <span class="pass"></span>
        </div>
  <input type="button" class="btn btn-default" name="reg" value="注&nbsp;&nbsp;&nbsp;册" id="reg">
  
  <div class="formbg"></div>
      </form>
	  
	  <?php require_once("footer.php");?>