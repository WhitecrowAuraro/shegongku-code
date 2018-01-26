<?php
require_once ('conf.php');
?>
<?php error_reporting(0); ?><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="bootstrap.min.css">

﻿
<script language="javascript">
	if (theForm.member_user.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("你倒是输入啊！");
		theForm.member_user.focus();   
		return (false);   
	}		
	
	if (theForm.member_password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("密码不能为空！");
		theForm.member_password.focus();   
		return (false);   
	}	
	
	if (theForm.member_password.value != theForm.pass.value){
		alert("两次输入密码不一样！");
		theForm.pass.focus();   
		return (false);   
	}	
		 
	if (theForm.member_name.value.replace(/(^\s*)|(\s*$)/g, "") == "" || theForm.member_name.value.replace(/[\u4e00-\u9fa5]/g, "")){
		alert("真实姓名不能为空且必须为中文！");   
		theForm.member_name.focus();   
		return (false);   
	}
}
</script>
<?php
if($_POST["submit"]){
if(empty($_POST['member_user']))
	echo "<script>alert('帐号不能为空');location='?tj=register';</script>";
else if(empty($_POST['member_password']))
	echo "<script>alert('密码不能为空');location='?tj=register';</script>";
else if($_POST['member_password']!=$_POST['pass'])
	echo "<script>alert('两次密码不一样');location='?tj=register';</script>";
else if(!empty($_POST['member_qq'])&&!is_numeric($_POST['member_qq']))
	echo "<script>alert('qq号必须全为数字');location='?tj=register';</script>";
else if(!empty($_POST['member_phone'])&&!is_numeric($_POST['member_phone']))
	echo "<script>alert('手机号码必须全为数字');location='?tj=register';</script>";
else if(!empty($_POST['member_email'])&&!ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)",$_POST['member_email']))
	echo "<script>alert('邮箱输入不合法');location='?tj=register';</script>";
else{
$_SESSION['member']=$_POST['member_user'];
$sql="insert into member values(null,'".$_POST['member_user']."','".md5($_POST['member_password'])."','".$_POST['member_name']."','".$_POST['member_sex']."','".$_POST['member_qq']."','".$_POST['member_phone']."','".$_POST['member_email']."')";
$result=mysql_query($sql)or die(mysql_error());
if($result)
echo "<script>alert('注册成功,请刷新');location='dl.php';</script>";
else
{
	echo "<script>alert('注册失败');location='pass.php?tj=register';</script>";
	mysql_close();
}
	}
}
?>

<style type="text/css">
<!--
body,td,th {
	color: #000000;
}
body {
	background-color: #FFFFFF;
}
.STYLE2 {font-size: 12px; }
-->
</style></head>
<body>
<?php if($_GET['tj'] == 'register'){ ?>
<form id="theForm" name="theForm" method="post" action="" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
      <td width="228" height="36" bgcolor="#FFFFFF"><input  placeholder="用户名~"  name="member_user" type="text" class="form-control" id="member_user" size="20" maxlength="20" /></td>
    </tr>
    <tr><br>
      <td height="36"><input placeholder="密码~" name="member_password" type="password" class="form-control" id="member_password" size="20" maxlength="20" /></td>
    </tr>
    <tr><br>
      <td height="36"><input placeholder="确认密码~" name="pass" type="password" class="form-control" id="pass" size="20" /></td>
    </tr>
    <tr><br>
      <td height="36"><input placeholder="姓名~" name="member_name" type="text" class="form-control" id="member_name" size="20" />
      <label></label></td>
    </tr>
    <tr><br>
      <td height="36"><input  placeholder="邮箱~"  name="member_email" type="text" class="form-control" id="member_email" size="20"/></td>
    </tr>
    <tr>
      <td height="51" colspan="2" align="center" bgcolor="#FFFFFF"><div align="right">
        <input name="submit" type="submit" class="btn btn-success" id="submit" value="注册" />
      </div></td>
    </tr>
  </table>
</form>
<?php
} 
	if($_GET['tj']== ''){
?>
<?php
if($_POST["submit2"]){
$name=$_POST['name'];
$pw=md5($_POST['password']);
$sql="select * from member where member_user='".$name."'"; 
$result=mysql_query($sql) or die("账号不正确");
$num=mysql_num_rows($result);
if($num==0){
	echo "<script>alert('帐号不存在');location='pass.php';</script>";
	}
while($rs=mysql_fetch_object($result))
{
	if($rs->member_password!=$pw)
	{
		echo "<script>alert('密码不正确');location='pass.php';</script>";
		mysql_close();
	}
	else 
	{
		$_SESSION['member']=$_POST['name'];
		header('Location:/index.php');
		mysql_close();
		}
	}
}
?>
<form action="" method="post" name="regform" onSubmit="return Checklogin();" style="margin-bottom:0px;">
<table width="229" height="132" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#00FF00" bgcolor="#000000">
    <tr>

      <td width="4" rowspan="2" align="center" class="h5">&nbsp;</td>
      <td width="299" height="60" class="font"><div align="left">
        <input placeholder="用户名~" name="name" type="text" class="form-control" id="name">
      </div></td>
    </tr>
    <tr>
      <br>
      <td height="36" class="font"><input placeholder="密码~" name="password" type="password" class="form-control" id="name">        </td>
    </tr>
    <tr>
    <td colspan="2" align="center" valign="top" class="font"><div align="right">
      <input name="submit2" type="submit" class="btn btn-success" value="会员登录"/>
    </div></td>
  </tr>
</table>
</form>
<?php } ?>
    
</body>
</html>