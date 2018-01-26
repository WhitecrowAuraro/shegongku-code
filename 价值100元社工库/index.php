
<!DOCTYPE html>
<HTML> 
<HEAD> 
<title>社工库- bi99v</title>
<meta name="description" content="bi99v。">
<meta name="keywords" content="t00ls">
<script type="text/javascript">
if (window!=top)
top.location.href =window.location.href;
</script>
<?php 
error_reporting(E_ALL & ~E_NOTICE); // 
require_once ('conf.php'); 
//显示用户
$sql="select * from member where member_user='".$_SESSION['member']."'";
$rs=mysql_fetch_array(mysql_query($sql));
?>
<?php
//注销操作
if($_GET["tj"]=="destroy"){
session_destroy();
echo "<script>alert('退出成功');location='index.php';</script>";}
?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand hidden-sm" href="/">社工查询库</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">首页</a></li>
                          <?php 
	  if(empty($_SESSION['member'])){
	  ?> 
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">登陆<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="">
                  <iframe class="wmff_zjkkzz" src="pass.php" align="center" width="300" height="200"    frameborder="0" scrolling="no"></iframe>
                </li>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">注册<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <iframe class="wmff_zjkkzz" src="pass.php?tj=register" align="center" width="300" height="320"    frameborder="0" scrolling="no"></iframe>
                </li>
              </ul>
            </li>
            <li><a href="http://www.t00ls.net /" target="_blank">论坛</a></li>
            <li><a href="http://www.t00ls.net/">关于</a></li>
   
          </ul>
        </div>
      </div>
    </div>


<script type="text/javascript">function cnrv_msg(str){alert(str);}</script><style type="text/css"></style></head>
<body>

    <div class="jumbotron">
      <div  style="margin:0 auto;width: 1000px;"><br>
			<div class="h6">

<?php  }else{  ?>
			 
                          <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">用户<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="">
			  用户名：<?php echo htmlspecialchars($rs['member_name']); ?> <br>用户：<strong><? echo $rs['member_user'];?></strong>

                </li>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">操作<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                 <a href='index.php?tj=destroy'>注销本次登录</a>
                </li>
              </ul>
            </li>
            <li><a href="http://www.t00ls.net/" target="_blank">论坛</a></li>
            <li><a href="http://www.t00ls.net/">关于</a></li>
          </ul>
        </div>
      </div>
    </div>
  <?php }?>
<SCRIPT LANGUAGE="Javascript"> 
<!-- 
var Words ="%20%3Chtml%20lang%3D%22zh-cn%22%3E%0A%20%20%3Chead%3E%0A%20%20%20%20%3Cmeta%20charset%3D%22utf-8%22%3E%0A%20%20%20%20%3Cmeta%20http-equiv%3D%22X-UA-Compatible%22%20content%3D%22IE%3Dedge%22%3E%0A%20%20%20%20%3Cmeta%20name%3D%22viewport%22%20content%3D%22width%3Ddevice-width%2C%20initial-scale%3D1.0%22%3E%0A%20%20%20%20%3Cmeta%20name%3D%22description%22%20content%3D%22%22%3E%0A%20%20%20%20%3Cmeta%20name%3D%22author%22%20content%3D%22%22%3E%0A%20%20%20%20%3Clink%20href%3D%22./static/css/bootstrap.css%22%20rel%3D%22stylesheet%22%3E%0A%09%20%3Clink%20href%3D%22./static/css/style.css%22%20rel%3D%22stylesheet%22%3E%0A%20%20%20%20%3Clink%20href%3D%22http%3A//cdn.bootcss.com/twitter-bootstrap/3.0.2/css/bootstrap.min.css%22%20rel%3D%22stylesheet%22%3E%0A%20%20%3Cstyle%20type%3D%22text/css%22%3E%0A%3C%21--%0A.STYLE2%20%7Bfont-size%3A%2080px%7D%0A--%3E%0A%20%20%3C/style%3E%0A%3C/head%3E%0A%0A%20%20%20%20%20%20%3C/div%3E%3C%21--%20End%20Navbar%20--%3E%0A%20%20%3Cbody%3E%0A%0A%20%20%3Cscript%20src%3D%22./static/js/jquery.js%22%3E%3C/script%3E%0A%20%20%3Cscript%20src%3D%22./static/js/system.js%22%3E%3C/script%3E%0A%20%20%3Cscript%20src%3D%22./static/js/administry.js%22%3E%3C/script%3E%0A%20%20%3Cscript%20src%3D%22./static/js/bootstrap.min.js%22%3E%3C/script%3E%20%0A%20%20%3Cscript%20src%3D%22./ajax.php%3Fact%3Ddatabase%22%3E%3C/script%3E%0A%3Clink%20rel%3D%22stylesheet%22%20href%3D%22bootstrap.min.css%22%3E%0A%3Clink%20rel%3D%22stylesheet%22%20href%3D%22http%3A//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap-theme.min.css%22%3E%0A%20%20%20%20%3Cdiv%20class%3D%22jumbotron%22%3E%0A%20%20%20%20%20%20%3Cdiv%20%20style%3D%22margin%3A0%20auto%3Bwidth%3A%201000px%3B%22%3E%3Cbr%3E%0A%09%09%09%3Cdiv%20class%3D%22h6%22%3E%0A%09%09%09%20%20%3Cdiv%20class%3D%22jumbotron%20search-box%22%3E%0A%20%20%3Cp%3E%3Cspan%20class%3D%22input-group%22%3E%0A%20%20%20%20%0A%20%20%3C/span%3E%3Cspan%20class%3D%22input-group%22%3E%0A%20%20%3Cselect%20class%3D%22btn%20btn-success%22%20id%3D%22match_act%22%20name%3D%22match_act%22%3E%0A%20%20%20%20%3Coption%20value%3D%221%22%20selected%3D%22%22%3E%u53F3%u5339%u914D%3C/option%3E%0A%20%20%20%20%3Coption%20value%3D%222%22%3E%u7CBE%u786E%u67E5%u8BE2%3C/option%3E%0A%20%20%3C/select%3E%0A%20%0A%20%20%3Cselect%20class%3D%22btn%20btn-primary%22%20id%3D%22select_act%22%20name%3D%22select_act%22%3E%0A%20%20%20%20%3Coption%20class%3D%22btn-group%22%20value%3D%223%22%20selected%3D%22%22%3EUser%20and%20Email%3C/option%3E%0A%20%20%20%20%3Coption%20%20class%3D%22btn-group%22%20value%3D%221%22%3EUsername%3C/option%3E%0A%20%20%20%20%3Coption%20class%3D%22btn-group%22%20value%3D%222%22%3EEmail%3C/option%3E%0A%20%20%3C/select%3E%0A%20%20%3C/span%3E%3C/p%3E%0A%20%20%3Cdiv%20id%3D%22jshint-pitch%22%20class%3D%22alert%20alert-info%20scan-wait%22%20style%3D%22display%3Anone%3Bmargin-top%3A10px%3Bfont-size%3A14px%22%3E%0A%20%20%20%0A%20%20%3C/div%3E%0A%20%20%3Cdiv%20id%3D%22scan-result-box%22%20style%3D%22font-size%3A12px%3B%22%3E%0A%20%20%20%20%3Cdiv%20class%3D%22input-group%22%3E%3Cspan%20class%3D%22input-group-btn%20scan-but-span%22%3E%0A%20%20%20%20%20%20%3Cbutton%20type%3D%22button%22%20class%3D%22btn%20btn-success%22%20onClick%3D%22getdata%28%29%3B%22%3ETry%20it%21%3C/button%3E%0A%20%20%20%20%20%20%3C/span%3E%0A%20%20%20%20%20%20%3Cinput%20placeholder%3D%22%u770B%u770B%u4F60%u7684%u5BC6%u7801%u662F%u5426%u6CC4%u9732%7E%7E%7E%22%20%20name%3D%22key%22%20class%3D%22form-control%22%20id%3D%22key%22%20%3E%0A%20%20%20%20%3C/div%3E%0A%3C/div%3E%0A%20%20%3Cdiv%20class%3D%22alert%20alert-warning%20error-box%22%20style%3D%22display%3Anone%3Bmargin-top%3A10px%3Bfont-size%3A14px%22%3E%3C/div%3E" //put your cripto code there 
function OutWord() 
{ 
var NewWords; 
NewWords = unescape(Words); 
document.write(NewWords); 
} 
OutWord(); 
// --> 

</SCRIPT> 
<style type="text/css">
<!--
h1, h2, h3, h4, h5, h6, .button {
  font-family: 'Alfa Slab One', cursive;
  font-weight: 400;
}
h1 {
  font-size: 72px;
  margin-bottom: 0;
}
.logo {
  color: rgb(240,239,220);
}
.logo span {
  color: rgb(222,69,91);
}
.logo img {
  width: 113px;
  display: inline-block;
  vertical-align: bottom;
}
.bs-callout {
margin: 20px 0;
padding: 15px 30px 15px 15px;
border-left: 5px solid #000000;
}
.STYLE2 {font-size: 80px}
.STYLE2 {font-size: 100px}
.STYLE3 {color: #FF0000}
.STYLE5 {font-size: 12px}
.alert-info {
color: #000000;
background-color: #FFFFFF;
border-color: #000000;
}
.navbar-inverse {
-webkit-box-shadow: #000 0px 0px 5px;
-moz-box-shadow: rgba(0,0,0,1) -5px 0px 5px;
-o-box-shadow: rgba(0,0,0,1) 0px 0px 5px;
box-shadow: #000 0px 0px 5px;
border-bottom: 1px solid #999;}
.bs-callout {
padding: 10px 20px;
}
.mt0 {
margin-top: 0px;
}
.bs-callout-info {
border-left-color: #C0C0C0;
}
.bs-callout {
padding: 20px;
margin: 20px 0;
border: 1px solid #eee;
border-left-width: 5px;
border-radius: 3px;
}
.bs-callout-info {
border-left-color: #5bc0de;
}
.bs-callout {
margin: 20px 0;
padding: 15px 30px 15px 15px;
border-left: 5px solid #EEE;}
body {
font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
font-size: 13px;
line-height: 1.42857143;
color: #000000;
background-color: #fff;
}
.jumbotron {
padding: 30px;
margin-bottom: 30px;
font-size: 13px;
font-weight: 200;
line-height: 2.1428571435;
color: inherit;
background-color: #FFF;
}
div.progress span {
display: block;
margin-top: -5px;
padding: 0;
text-align: center;
width: 0;
-moz-box-shadow: 1px 0 1px rgba(0, 0, 0, 0.2);
-webkit-box-shadow: 1px 0 1px rgba(0, 0, 0, 0.2);
box-shadow: 1px 0 1px rgba(0, 0, 0, 0.2);
}
-->
  </style>
</HEAD> 
<BODY>
<div align="center"> <li><a href="http://www.t00ls.net/">By：bi99v</a></li></a>
</div>
</BODY> 
</HTML>
<div style="display:none;" id="selecting" class="progress progress-striped active progress-info"><span><b></b></span></div>
<table  style="font-size:12px;display:none;" id="somd5_table" >
<thead>
<tr>
	  <th width="30%">用户名/账号</th>
		<th width="30%">邮箱</th>
		<th width="30%">密码类</th>
		<th width="30%">来源</th>
	</tr>
</thead>
<tbody id="value_tables">

	</tbody>
</table>
</div>
</div>
<!-- 
var Words ="%09%20%20%0A%09%20%20%0A%0A%20%20%20%20%3Cdiv%20class%3D%22container%22%3E%3C/div%3E%20%0A%3C%21--%20/container%20--%3E%0A%0A%0A%20%20%20%20%3C%21--%20Bootstrap%20core%20JavaScript%0A%20%20%20%20%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%3D%20--%3E%0A%20%20%3Cscript%20src%3D%22./static/js/jquery.js%22%3E%3C/script%3E%0A%20%20%3Cscript%20src%3D%22./static/js/system.js%22%3E%3C/script%3E%0A%20%20%3Cscript%20src%3D%22./static/js/administry.js%22%3E%3C/script%3E%0A%20%20%3Cscript%20src%3D%22./static/js/bootstrap.min.js%22%3E%3C/script%3E"  
function OutWord() 
{ 
var NewWords; 
NewWords = unescape(Words); 
document.write(NewWords); 
} 
OutWord(); 
// --> 
</SCRIPT> 
</HEAD> 
<BODY> 
</BODY> 
</HTML>

