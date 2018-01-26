<?php
require_once("db.class.php");
define('IN_TM', TRUE);
$mysql=new mysql("localhost","root","root","somd5","utf8");

function pass($str){
return md5(sha1(md5(sha1($str.$str))));
}



/*
*配置
*/
$config['admin']="管理员帐号";//管理员账号
$config['pass']="管理员密码";//管理员密码


$config['name']="社工库";//名称
$config['title']="社工库";//网站标题
$config['keywords']="社工库";//关键词
$config['description']="社工库";//描述
$config['ad']="本社工库所有数据均来至于互联网，切勿用于非法用途";//公告
$config['news']="社工库";
/*
*导航链接
*/
$nav=Array(
//"导航名称"=>"导航链接",
"邀请码"=>"http://wpa.qq.com/msgrd?v=3&uin="
);
/*
*友情链接
*/
$link=Array(
//"链接名称"=>"链接地址",
"百度"=>"http://www.baidu.com/",
);

function k($str,$msg,$url){
if(empty($str)){
	$msg=$msg;
	$url=$url;
   require_once("msg.php");
   exit;
}
return true;
}

function mailsend($biaoti,$msg,$to){
	require_once "email.class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = $to;//发送给谁
	$smtpuser = "帐号";//SMTP服务器的用户帐号
	$smtppass = "密码";//SMTP服务器的用户密码
	$mailtitle = $biaoti;//邮件主题
	$message = "
<div id='mailContentContainer' class='qmbox' style='height: auto; min-height: 100px; word-wrap: break-word; font-size: 14px; padding: 0px; font-family: 'lucida Grande', Verdana;'>
尊敬的用户, 您好:<br>
=================================================<br>
如此邮件在垃圾箱中, 请将我们添加到信任列表, 非常感谢.<br>
=================================================<br>
<p>".$msg."</p>
<br>
<a href='#'>本邮件由社工库系统自动发送</a>

  </div>
";
	$mailcontent =$message;//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
}

function randomkeys($length){
			$arr   = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')); 
			shuffle($arr); 
			$str = implode('', array_slice($arr, 0, $length)); 
			return $str; 
		}
		
function auth(){
if (empty($_SESSION['name'])) {
    header("Location: index.php?act=login");
    exit;
}
}
		
function getIP() { 
if (getenv('HTTP_CLIENT_IP')) { 
$ip = getenv('HTTP_CLIENT_IP'); 
} 
elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
$ip = getenv('HTTP_X_FORWARDED_FOR'); 
} 
elseif (getenv('HTTP_X_FORWARDED')) { 
$ip = getenv('HTTP_X_FORWARDED'); 
} 
elseif (getenv('HTTP_FORWARDED_FOR')) { 
$ip = getenv('HTTP_FORWARDED_FOR'); 

} 
elseif (getenv('HTTP_FORWARDED')) { 
$ip = getenv('HTTP_FORWARDED'); 
} 
else { 
$ip = $_SERVER['REMOTE_ADDR']; 
} 
return $ip; 
} 
//$sql=$mysql->select("*","admin","id","3");//选择数据
//print_r($sql);//打印返回的数组
//$mysql->insert("admin","user_name,user_pass","'123','123'");插入数据
//$mysql->update("admin","user_pass","22","id","3");更新数据
//$mysql->delete("admin","id","4");删除数据
//$mysql->close();关闭连接

?>