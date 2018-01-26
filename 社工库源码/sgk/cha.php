<html>
<head>
<title>CNSEU社工库查询</title>
</head>
<body onLoad="document.form1.a1.select();" background="logo的地址" ondragstart="return false" oncontextmenu="return false" onselectstart="return false" onselect=document.selection.empty()>
<div align="center"><b>CNSEU社工库查询</b></div>
<br>
<br>
<br>
<br>
<div align="center"><form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
请输入目标：<input type="text" name="search">
<input type="submit" name="submit" value="查询">
<input type="reset" name="submit2" value="重新输入">
</form></div>

<?php
$link = mysql_connect("localhost", "root", "root");
mysql_select_db("somd5");
//mydatabase bbs
$search=$_POST['search'];
if(!empty($_POST['search'])){
//$sql="SELECT * FROM bbs WHERE name = '$search'";
$sql="SELECT * FROM bbs WHERE name = '$search' or email = '$search'";
}else{
  echo "搜索不能为空";
  exit();
}
//echo $sql;
$query=mysql_query($sql);
?>

<div align="center"><table>
    <tr height="20">
    <td width="10%">帐号</td>
    <td width="32%">密码</td>
    <td width="6%">salt</td>
    <td width="20%">邮箱</td>
    <td width="8%">site</td>
    <td width="25%">ip</td>
    </tr></div>
<?php
while($row=mysql_fetch_assoc($query))
{
    ?>
    
    <tr>
    <td width="10%"><?=$row['name']?></td>
    <td width="32%"><?=$row['pass']?></td>
    <td width="6%"><?=$row['salt']?></td>
    <td width="20%"><?=$row['email']?></td>
    <td width="8%"><?=$row['site']?></td>
    <td width="25%"><?=$row['ip']?></td>
    </tr>
    
    <?php
}
mysql_close($link);//这个至关重要必须要关闭 
?>
</table>
    
</body>