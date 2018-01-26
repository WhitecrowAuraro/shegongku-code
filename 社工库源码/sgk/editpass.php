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
if ($("#pass").val()==""){
     $.jBox.error('当前密码没有填写哦~!', '<?php echo $config['name'];?>');
	 	 $("#pass").focus();
	 	return false;
}
if ($("#passcache").val()==""){
     $.jBox.error('新密码没有填写~!', '<?php echo $config['name'];?>');
	 	 	 $("#passcache").focus();
	 	return false;
}

$("#regact").submit();
  });
});
</script>


	 <form role="form" id="regact" method="post" action="index.php?act=editpassMethod">
      <div class="qtitle">密码修改</div>

        <div class="form-group">
           <input type="password" class="form-control isicon" name="pass" id="pass" placeholder="当前密码">
           <span class="pass"></span>
        </div>
         <div class="form-group">
           <input type="password" class="form-control isicon" name="passcache" id="passcache" placeholder="新密码">
           <span class="pass"></span>
        </div>

  <input type="button" class="btn btn-default" name="reg" value="修&nbsp;&nbsp;&nbsp;改" id="reg">
  
  <div class="formbg"></div>
      </form>
	  
	  <?php require_once("footer.php");?>