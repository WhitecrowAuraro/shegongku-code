<?php
/*
*Author:Cani301
*http://www.97bug.com
*/

$time_start = microtime(true);
define('ROOT', dirname(__FILE__).'/');
define('MATCH_LENGTH', 0.1*1024*1024);	//字符串长度 0.1M 自己设置，一般够了。
define('RESULT_LIMIT',100);


function my_scandir($path){//获取数据文件地址
	$filelist=array();
	if($handle=opendir($path)){
		while (($file=readdir($handle))!==false){
			if($file!="." && $file !=".."){
				if(is_dir($path."/".$file)){
					$filelist=array_merge($filelist,my_scandir($path."/".$file));
				}else{
					$filelist[]=$path."/".$file;
				}
			}
		}
	}
	closedir($handle);
	return $filelist;
}

function get_results($keyword){//查询
	$return=array();
	$count=0;
	$datas=my_scandir(ROOT."xdatas#"); //数据库文档目录
	if(!empty($datas))foreach($datas as $filepath){
		$filename = basename($filepath);
		$start = 0;
		$fp = fopen($filepath, 'r');
			while(!feof($fp)){
				fseek($fp, $start);
				$content = fread($fp, MATCH_LENGTH);
				$content.=(feof($fp))?"\n":'';
				$content_length = strrpos($content, "\n");
				$content = substr($content, 0, $content_length);
				$start += $content_length;
				$end_pos = 0;
				while (($end_pos = strpos($content, $keyword, $end_pos)) !== false){
					$start_pos = strrpos($content, "\n", -$content_length + $end_pos);
					$start_pos = ($start_pos === false)?0:$start_pos;
					$end_pos = strpos($content, "\n", $end_pos);
					$end_pos=($end_pos===false)?$content_length:$end_pos;
					$return[]=array(
									'f'=>$filename,
									't'=>trim(substr($content, $start_pos, $end_pos-$start_pos))
								);
					$count++;
					if ($count >= RESULT_LIMIT) break;
				}
				unset($content,$content_length,$start_pos,$end_pos);
				if ($count >= RESULT_LIMIT) break;
			}
		fclose($fp);
		if ($count >= RESULT_LIMIT) break;
	}
	return $return;
}


if(!empty($_POST)&&!empty($_POST['q'])){
	set_time_limit(0);				//不限定脚本执行时间
	$q=strip_tags(trim($_POST['q']));
	$results=get_results($q);
	$count=count($results);
}
 
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Social Engineering Data 社工库/社工数据库- Powered By JulyTeam </title>
<meta name="copyright" content="cha.97bug.com,0daydata.com" />
<meta name="keywords" content="SED,社工库,社工数据,社工密码,渗透,黑客数据查询,Social Engineering Data" />
<meta name="description" content="一款由柒月网络安全技术小组提供的Social Engineering Data 社工库/社工数据库查询工具。帮助您判断您的密码或个人信息是否已经被公开或泄漏。柒月网络,关注互联网安全技术,提供互联网共享服务。" />
<link rel="stylesheet" type="text/css" href="html/default.css" />
	<style type="text/css">
	body,td,th {
	color: #FFF;
}
    a:link {
	color: #0C0;
	text-decoration: none;
}
    body {
	background-color: #000;
}
    a:visited {
	text-decoration: none;
	color: #999;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
	color: #F00;
}
    </style>
<script>
<!--
    function check(form){
if(form.q.value==""){
  alert("Not null！");
  form.q.focus();
  return false;
 }
}
-->
</script>
	</head>
	<body>
	<div id="container"><div id="header"><a href="http://cha.97bug.com" ><h1>Social Engineering Data</h1></a></div><br /><br />

<form name="from"action="Search.php" method="post">
			<div id="content"><div id="create_form"><label>Please input Keyword：<input class="inurl" size="26" id="unurl" name="q" value="<?php echo !empty($q)?$q:''; ?>"/></label>
	<p class="ali"><label for="alias">Key Words:</label><span>User,Email,QQ Account,Forum Account...</span></p><p class="but"><input onclick="check(form)" type="submit" value="Search" class="submit" /></p>
		</form></div>﻿
		<?php
		if(isset($count)){
			echo 'Get ' . $count . ' results, cost ' . (microtime(true) - $time_start) . " seconds"; 
			if(!empty($results)){
				echo '<ul>';
				foreach($results as $v){
					echo '<li>From_['.$v['f'].']_Datas <br />Content:　'.$v['t'].'</li>';
				}
				echo '<br /><br /><font color=#ffff00><li>Resources from the Internet.<br />The information here does not represent the views of this site.</li></font>';
				echo '</ul>';
			}
			        echo '<hr align="center" width="550" color="#2F2F2F" size="1"><font color=#ff0000>We cannot guarantee the entirely accurate,please voluntarily judge.';
				echo '<br />The data is not complete? Do you want to add or remove it?';
				echo '<br />Contact Email:anon@97bug.com</font>';
				echo '</ul>';
		}
		?>
		<div id="nav">
<ul><li class="current"><a href="./">Search Data</a></li><li><a href="about.html" target="_blank">Abouts</a></li></ul>
</div>
<div id="footer">
<p>Social Engineering Data ©2010-2012 Powered By <a href="http://www.97bug.com/" target="_blank">JulyTeam<a></p><div style="display:none">
<script src="http://s21.cnzz.com/stat.php?id=4843223&web_id=4843223" language="JavaScript"></script>
</div>
</div>
</body>
</html>