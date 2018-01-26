<?php
session_start();
if (!isset ($_SESSION)) {
	ob_start();
	
}
 $hostname="localhost"; //mysql地址
 $basename="root"; //mysql用户名
 $basepass="root"; //mysql密码
 $database="sgk2"; //mysql数据库名称

 $conn=mysql_connect($hostname,$basename,$basepass)or die("error!"); //连接mysql              
 mysql_select_db($database,$conn); //选择mysql数据库
 mysql_query("set names 'utf8'");//mysql编码
?>