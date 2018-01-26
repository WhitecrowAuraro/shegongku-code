<?php
if(!defined('IN_TM')) 
{
exit('Access Denied');
}
?>
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title><?php echo $config['title'];?></title>
	    <meta name="description" content="<?php echo $config['description'];?>">
	    <meta name="keywords" content="<?php echo $config['keywords'];?>">
	    <link rel="icon" href="http://runing.cdn.duapp.com/style/favicon.ico" type="image/x-icon" />
		
		
	   <!-- <link href="http://runing.cdn.duapp.com/style/dist/css/bootstrap.css" rel="stylesheet">
	    <link href="http://runing.cdn.duapp.com/style/style.css" rel="stylesheet">-->
		<link href="/res/style.css" rel="stylesheet">
		
	    <script src="http://runing.cdn.duapp.com/style/jquery.js"></script>
	    <script src="http://runing.cdn.duapp.com/style/template.js"></script>
	    <script src="http://runing.cdn.duapp.com/style/dist/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="jBox/jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="jBox/jquery.jBox-2.3.min.js"></script>
  <script type="text/javascript" src="jBox/i18n/jquery.jBox-zh-CN.js"></script>
  <link type="text/css" rel="stylesheet" href="jBox/Skins/Blue/jbox.css"/>
<style>
table{table-layout: fixed;}
td{word-break: break-all; word-wrap:break-word;}
tr{height:auto;}
</style>
		</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a href="/" class="navbar-brand"><?php echo $config['name'];?></a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
			<?php	foreach ($nav as $name => $url){echo '<li><a href="'.$url.'" data-toggle="tooltip" data-placement="bottom" >'.$name.'</a></li>';}?>
	
				</ul>
				
				
				 <ul class='nav navbar-nav navbar-right'>
           	
				<?php
				
				if(empty($_SESSION['name'])){
	echo "<a href='index.php?act=login'>登录</a>&nbsp;<a href='index.php?act=reg'>注册</a>&nbsp;<a href='index.php?act=zhpass'>pass?</a>";
}else{ ?>
						
						
								
								<li class='divider-vertical'>
								</li>
								<li class='dropdown'>
									 <a data-toggle='dropdown' class='dropdown-toggle' href='#'><i class='icon-user icon-white'></i><?php echo $_SESSION['name'];?><strong class='caret'></strong></a>
									<ul class='dropdown-menu'>
										<li>
											<a href='index.php?act=scanlog'><i class='icon-hand-right'></i>查询记录</a>
										</li>
										<li>
											<a href='index.php?act=editpass'><i class='icon-shopping-cart'></i>修改密码</a>
										</li>
										<li class='divider'>
										</li>
										<li>
											<a href='index.php?act=out'><i class='icon-off'></i>退出</a>
										</li>
									</ul>
								</li>

		          </ul>

				<?php } ?>
				
				
				
				
			</div>
		</div>
	</div>
    	<div class="container" style="padding-top: 48px;">
		<!--<div class="alert alert-danger">
<?php //echo $config['ad'];?>			
		</div>-->
		<!--div class="qtop"><span></span></div-->
