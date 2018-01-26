<?php
// 引用sphinxapi类
require ( "sphinxapi.php" );
//关闭错误提示
error_reporting(E_ALL & ~E_NOTICE);
$num = 0;
if(!empty($_GET)&&!empty($_GET['q'])){
	$Keywords=strip_tags(trim($_GET['q']));
	if(!empty($_GET['m'])&&$_GET['m']==1){
		$Keywords=substr(md5($Keywords),8,16);
	}
	if(!empty($_GET['m'])&&$_GET['m']==2){
		$Keywords=md5($Keywords);
	}
	$cl = new SphinxClient ();
	// 返回结果设置
	$opts = array
	(
		"before_match"		=> "<font color=red>",
		"after_match"		=> "</font>",
		"chunk_separator"	=> " ... ",
		"limit"				=> 150,
		"around"			=> 3,
	);
	$cl->SetServer ('127.0.0.1', 9312);
	$cl->SetConnectTimeout ( 3 );
	$cl->SetArrayResult ( true );
	// 设置是否全文匹配
	if(!empty($_GET)&&!empty($_GET['f'])){
		$cl->SetMatchMode(SPH_MATCH_ALL);
	}
	else
	{
		$cl->SetMatchMode(SPH_MATCH_ANY);
	}
	if(!empty($_GET)&&!empty($_GET['p'])){
		$p = !intval(trim($_GET['p']))==0?intval(trim($_GET['p']))-1:0;
		$p = $p *20;
		// 我在csft.conf 设置了最大返回结果数2000。但是我在生成页码的时候 最多生成20页，我想能满足大部分搜索需求了。
		// 以下语句表示从P参数偏移开始每次返回20条。
		$cl->setLimits($p,20);
	}
	else
	{
		$cl->setLimits(0,20);
	}
	
	$res = $cl->Query ( ".$Keywords.", "*" );

	mysql_connect("localhost","IndexData","NTsGNpSwKBGh");  //数据库账号密码
	mysql_select_db("IndexData");								//数据库库名名

	if ( is_array($res["matches"]) )
	{
		foreach ( $res["matches"] as $docinfo )
		{
			$ids = $ids.$docinfo[id].',';
		}
		$ids = rtrim($ids,','); 
		$sql = "select * from sed_data where id in($ids)";		//注意修改表名
		mysql_query("set names utf8");
		$ret = mysql_query($sql);
		$num = mysql_num_rows($ret);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>The Web of Answers</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Author" content="Ph4nt0m" />
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
.pages{
	clear: both;
	text-align: right;
	padding: 8px 0;
}
.pages a{
	display: inline-block;
	height: 20px;
	line-height: 20px;
	border: 1px solid #228B22;
	padding: 0 8px;
	color: #228B22;
	margin: 5px 2px;
	background: #2F2F2F;
}
.pages a:hover{
	background: #228B22;
	color: white;
}
.pages span {
	display: inline-block;
	height: 20px;
	line-height: 20px;
	border: 1px solid #228B22;
	padding: 0 8px;
	margin: 5px 2px;
	background: #228B22; /*#228B22;*/
	color: white;	
}
#create_form label{
	margin-left: 10px;
}
#create_form em{
	margin-left: 60px;
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
	<div id="container"><div id="header"><h1>The Web of Answers</h1></div><br /><br />
	<form name="from"action="Search.php" method="GET">
			<div id="content"><div id="create_form"><p><em></em><label for=""><input type="checkbox" name="f" value="1" <?php echo !empty($_GET['f'])?'checked':''; ?>/>完整匹配</label><label> <label for=""><input type="checkbox" name="m" value="1" <?php echo !empty($_GET['m'])?'checked':''; ?>/>MD5匹配</label></p><p style="text-align:center;margin:0 auto;"><label><input class="inurl" size="26" id="unurl" name="q" value="<?php echo strip_tags(trim($_GET['q'])); ?>"/></label><span class="but"><input onclick="check(form)" type="submit" value="Search" class="submit" /></span></p>
		</form></div>﻿
		<?php	
			if (!$num == 0){
				echo "<br/>找到与&nbsp{$Keywords}&nbsp相关的结果 {$res[total_found]} 个。用时 {$res[time]} 秒。<ol>";
				while ($row = mysql_fetch_assoc($ret)) {
					 $sql2 = "SELECT * FROM sed_name WHERE id =".$row['did'];  // 这里的表名也改改。根据数据库ID名查找数据库名称的。
					 $ret2 = mysql_query($sql2);
					 $retContent = $cl->BuildExcerpts($row,"test1",$Keywords,$opts);
					 echo '<li><font color=228B22>From_['.mysql_result($ret2, 0,"dataname").'_Datas]</font> <br /><font color=#00CD00>Content:</font>　'.$retContent[2].'</li><br/>';
					}
				echo '</ol>';
			} 
			else
			{
				if(!empty($_GET)&&!empty($_GET['q'])){
					echo "<br/>找不到与&nbsp{$Keywords}&nbsp相关的结果。请更换其他关键词试试。";
				    echo '<ul><hr align="center" width="550" color="#2F2F2F" size="1"><font color=#ff0000>We cannot guarantee the entirely accurate,please voluntarily judge.';
					echo '<br />The data is not complete? Do you want to add or remove it?';
					echo '<br />Contact Email:Phantom@email.com</font>';
					echo '</ul>';					
				}
			}

		?>
		<div class="pages">
			<?php
			if(!$num == 0){
				$pagecount = (int)($res[total_found] / 20);
				if(!($res[total_found] % 20)==0){ 
					$pagecount = $pagecount + 1;
				}
				if($pagecount>20){
					$pagecount = 20;
				}
				$highlightid = !intval(trim($_GET['p']))==0?intval(trim($_GET['p'])):1;
				// if($highlightid==0){ $highlightid = 1;}
				for ($i=1; $i <= $pagecount; $i++) { 
					if($highlightid==$i){
						echo "<span>{$i}</span>";
					}
					else
					{
						echo "<a href=\"Search.php?q={$Keywords}&p={$i}\">{$i}</a>";
					}
					
				}				
			}
			?>
		</div>
		<div id="nav">
		<ul><li class="current"><a href="http://www.wooyun.org" target="_blank">WooYun.org</a></li><li><a href="http://www.baidu.com" target="_blank">About Me</a></li></ul>
		</div>
<div id="footer">
<p>The Web of Answers &copy;2010-2014</p>
</div>
</div>
</body>
</html>