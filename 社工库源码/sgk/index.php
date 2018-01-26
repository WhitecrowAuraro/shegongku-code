<?php
session_start();
header("Content-type: text/html; charset=utf-8");
error_reporting(0);//屏蔽错误
require_once ("config.php");
switch ($_GET['act']) {
    case "reg":
        require_once ("reg.php");
        exit;
    case "login":
        require_once ("login.php");
        exit;
	case "scanlog":
		auth();
        require_once ("scanlog.php");
        exit;
	case "editpass":
		auth();
        require_once ("editpass.php");
        exit;
	case "zhpass":
        require_once ("zhpass.php");
        exit;
	case "zhpassMethod":
        $name = trim(mysql_real_escape_string($_POST['name']));
        $mail = trim(mysql_real_escape_string($_POST['mail']));
        $sql = $mysql->select("*", "user", "name", "'" . $name . "'"); //选择数据
        if (empty($sql)) {
            k($kong, "抱歉此用户不存在", "index.php?act=zhpass");
        }
		if($mail!=$sql['mail']){
            k($kong, "抱歉，邮箱不匹配", "index.php?act=zhpass");
		}
		 $data = randomkeys(6);//新明文密码
		 $pass= pass($data);
		 $mysql->update("user", "pass", "'{$pass}'", "name", "'{$name}'");
		 mailsend("社工库密码找回","新密码为:".$data,$mail);
         k($kong, "新密码已发送至您的邮箱", "index.php?act=zhpass");
		exit;
	case "editpassMethod":
		auth();
        $pass = trim(mysql_real_escape_string($_POST['pass']));
        $passcache = trim(mysql_real_escape_string($_POST['passcache']));
        k($pass, "当前密码为空", "index.php?act=editpass");
        k($passcache, "新密码为空", "index.php?act=editpass");
		$name=$_SESSION['name'];
        $sql = $mysql->select("*", "user", "name", "'{$name}'"); //选择数据
        $pass = pass($pass);
        $passcache = pass($passcache);
		if($pass!=$sql['pass']){
			k($kong, "当前密码错误", "index.php?act=editpass");
		}
		
			$mysql->update("user","pass","'{$passcache}'","name","'{$name}'"); 		
			k($kong, "密码修改成功", "index.php?act=editpass");
		exit;
    case "regMethod":
        $name = trim(mysql_real_escape_string($_POST['name']));
        $pass = trim(mysql_real_escape_string($_POST['pass']));
        $mail = trim(mysql_real_escape_string($_POST['mail']));
        $passcache = trim(mysql_real_escape_string($_POST['passcache']));
        $icode = trim(mysql_real_escape_string($_POST['icode']));
        k($name, "用户名为空", "index.php?act=reg");
        k($pass, "密码为空", "index.php?act=reg");
        k($mail, "邮箱为空", "index.php?act=reg");
        k($passcache, "重复密码为空", "index.php?act=reg");
        k($icode, "邀请码为空", "index.php?act=reg");
        if ($pass != $passcache) {
            k($kong, "两个密码不一样哦", "index.php?act=reg");
        }
        $sql = $mysql->select("*", "user", "name", "'" . $name . "'"); //选择数据
        if (!empty($sql)) {
            k($kong, "抱歉哦，此用户名已经有人注册啦", "index.php?act=reg");
        }
        $yqm = $mysql->select("*", "code", "code", "'" . $icode . "'"); //选择数据
        if (empty($yqm) || $yqm['mid'] == '1') {
            k($kong, "邀请码不存在或已使用", "index.php?act=reg");
        }
        $mid = $yqm['mid'];
        if ($mid == 1) {
            k($kong, "邀请码不存在或已使用", "index.php?act=reg");
        }
        $pass = pass($pass);
        $mysql->insert("user", "name,pass,mail,time,ip", "'" . $name . "','" . $pass . "','" . $mail . "','" . time() . "','" . getIP() . "'");
        $mysql->update("code", "mid", "1", "code", "'" . $icode . "'");
        $_SESSION['name'] = $name;
        $_SESSION['pass'] = $pass;
        $_SESSION['mail'] = $mail;
        $_SESSION['ip'] = getIP();
        k($kong, "注册成功", "index.php");
        exit;
    case "loginMethod":
        $name = trim(mysql_real_escape_string($_POST['name']));
        $pass = trim(mysql_real_escape_string($_POST['pass']));
        k($name, "用户名为空", "index.php?act=login");
        k($pass, "密码为空", "index.php?act=login");
        $sql = $mysql->select("*", "user", "name", "'" . $name . "'"); //选择数据
        if (empty($sql)) {
            k($kong, "你用户名输入错了吧，不存在哦", "index.php?act=login");
        }
        $pass = pass($pass);
        if ($sql['pass'] != $pass) {
            k($kong, "密码错误", "index.php?act=login");
        }
        $_SESSION['name'] = $name;
        $_SESSION['pass'] = $pass;
        $_SESSION['ip'] = getIP();
        k($kong, "登录成功", "index.php");
        exit;
    case "out":
        session_destroy();
        k($kong, "退出成功", "index.php?act=login");
        exit;
    case "admin":
        require_once ("admin.php");
        exit;
    case "icode_admin":
        $name = trim(mysql_real_escape_string($_POST['name']));
        $pass = trim(mysql_real_escape_string($_POST['pass']));
        k($name, "用户名为空", "index.php?act=admin");
        k($pass, "密码为空", "index.php?act=admin");
        if ($config['pass'] != $pass || $config['admin'] != $name) {
            k($kong, "账号或密码错误", "index.php?act=admin");
        }
        $data = randomkeys(6);
        echo "生成的邀请码为:" . $data;
        $mysql->insert("code", "code", "'" . $data . "'");
        exit;
    default:;
}
if (empty($_SESSION['name'])) {
    header("Location: index.php?act=login");
    exit;
}
$name=$_SESSION['name'];
$time_start = microtime(true);
define('ROOT', dirname(__FILE__) . '/');
define('MATCH_LENGTH', 0.1 * 1024 * 1024); //字符串长度 0.1M
define('RESULT_LIMIT', 1000);
function my_scandir($path) { //获取数据文件地址
    $filelist = array();
    if ($handle = opendir($path)) {
        while (($file = readdir($handle)) !== false) {
            if ($file != "." && $file != "..") {
                if (is_dir($path . "/" . $file)) {
                    $filelist = array_merge($filelist, my_scandir($path . "/" . $file));
                } else {
                    $filelist[] = $path . "/" . $file;
                }
            }
        }
    }
    closedir($handle);
    return $filelist;
}
function get_results($keyword) { //查询
    $return = array();
    $count = 0;
    $datas = my_scandir(ROOT . "data");
    if (!empty($datas)) foreach ($datas as $filepath) {
        $filename = basename($filepath);
        $start = 0;
        $fp = fopen($filepath, 'r');
        while (!feof($fp)) {
            fseek($fp, $start);
            $content = fread($fp, MATCH_LENGTH);
            $content.= (feof($fp)) ? "\n" : '';
            $content_length = strrpos($content, "\n");
            $content = substr($content, 0, $content_length);
            $start+= $content_length;
            $end_pos = 0;
            while (($end_pos = strpos($content, $keyword, $end_pos)) !== false) {
                $start_pos = strrpos($content, "\n", -$content_length + $end_pos);
                $start_pos = ($start_pos === false) ? 0 : $start_pos;
                $end_pos = strpos($content, "\n", $end_pos);
                $end_pos = ($end_pos === false) ? $content_length : $end_pos;
                $return[] = array(
                    'f' => $filename,
                    't' => trim(substr($content, $start_pos, $end_pos - $start_pos))
                );
                $count++;
                if ($count >= RESULT_LIMIT) break;
            }
            unset($content, $content_length, $start_pos, $end_pos);
            if ($count >= RESULT_LIMIT) break;
        }
        fclose($fp);
        if ($count >= RESULT_LIMIT) break;
    }
    return $return;
}
function highLightKeyword($text, $kd, $color = "#C60A00") {
    $newword = "<font color=$color>$kd</font>";
    $text = str_replace($kd, $newword, $text);
    return $text;
}
function isOk_ip($ip){
 if(preg_match('/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1 -9]?\d))))$/', $ip))
{
return true;
}else{
return false;
}
}
function get_ip($ip){
	$data = curl_("http://api.somd5.com/cgi-bin/ipv4?ip=".$ip);
	return $data;
}
function is_ip($str){
	$iptest = isOk_ip($str);
	if($iptest){
	  return $str.get_ip($str);
	}
	return $str;
}

function is_md5($md5){
	$str=strlen(trim($md5));
	switch($str){
		case 16: break;
		case 32: break;
		default:return false;
	}
	if (!preg_match("/^([a-fA-F0-9]{".$str."})$/", $md5))
	{
		return false;
	}
	return md5get($md5);
}
function GetBetween($content,$start,$end){
		$r = explode($start, $content);
		if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
		}
		return '';
}
function curl_($url){
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_HEADER, false);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
	$result=curl_exec($ch);  
	curl_close($ch);
	return $result;
}
function md5get($md5){
$data = curl_("http://api.somd5.com/cgi-bin/md5api?Usernameencryption=60LDE8ncaM9&md5=".$md5);
$data1=GetBetween($data,",\"result\":","}");
if(empty($data1)){
	return false;
}
	$data2=GetBetween($data,',"result":"','"}');
	return ",解密:".$data2;
}


function get_sql_results($keyword) {

    $return = array();
    $link = mysql_connect("localhost", "root", "root");
    mysql_select_db("sj") or die('数据库连接失败！');
    mysql_query("SET names UTF8");
    if (!$link) die('数据库连接失败！');
    $keyword = urldecode($keyword);
    $results = mysql_query('SHOW TABLES');
    while ($tbrow = mysql_fetch_array($results)) {
        if (strlen($keyword) < 1) return null;
        //$sqlb="SELECT * FROM $tbrow[0] WHERE name like '%$keyword%' or email like '%$keyword%'";
        $sqlb = "SELECT * FROM $tbrow[0] WHERE pass like '" . $keyword . "%' or uname like '" . $keyword . "%' or email like '" . $keyword . "%' or salt like '" . $keyword . "%' ";
        //echo $sqlb ."<br/>";
        $query = mysql_query($sqlb);
        while ($row = mysql_fetch_assoc($query)) {
            $return[] = array(
                'name' => highLightKeyword($row['uname'], $keyword) ,
                'pass' => highLightKeyword($row['pass'], $keyword).is_md5($row['pass']),
                'salt' => $row['salt'],
                'email' => highLightKeyword($row['email'], $keyword) ,
                'site' => $row['site'],
                'ip' => is_ip($row['ip']),
            );
            $count++;
        }
    }
    mysql_close($link);
    return $return;
	
}
if (!empty($_POST) && !empty($_POST['q']) && $_POST['ajax'] == 1) {
    //set_time_limit(0);				//不限定脚本执行时间
    $q = strip_tags(trim($_POST['q']));
    //$results=get_results($q);
 	$name=$_SESSION['name'];
    $q2=urldecode($q);
    $mysql->insert("scanlog", "name,word", "'".$name."','".$q2."'");
    $results = get_sql_results($q);
   
    $count = count($results);
    if (isset($count)) {
        echo "<div class='alert alert-success' style='font-size:18px;'>
找到&nbsp;<span class='label label-success'>" . $count . "</span>&nbsp;条结果，耗时<span class='label label-info'>" . (microtime(true) - $time_start) . "</span>秒";
        if (!empty($results)) {
            echo '<table class="table table-hover"><thead><tr><th>#</th><th>帐号</th><th>密码</th><th>Salt</th><th>邮箱</th><th>Site</th><th>IP</th></tr></thead>  <tbody style="font-size:10px">';
            $i = 1;
            foreach ($results as $v) {
                echo ' <tr><td>' . $i . '</td><td>' . $v['name'] . '</td><td>' . $v['pass'] . '</td><td>' . $v['salt'] . '</td><td>' . $v['email'] . '</td><td>' . $v['site'] . '</td><td>' . $v['ip'] . '</td></tr>';
                $i++;
            }
            echo ' </tbody></table></div>';
        }
    }
    exit;
}
?>

<?php
require_once ("header.php"); ?>
		<div class="jumbotron search-box" style="background-color: transparent;">

			<p>Please input Keyword：</p>
			<div class="input-group">
				<input placeholder="User,Email,QQ Account,Forum Account..."
					type="text" id="key" class="form-control" style="
    background: url(res/images/bg.png) repeat-y -60px;
">
				<span class="input-group-btn scan-but-span">
					<button class="btn btn-success" onclick="get_scan()" type="button">爆菊</button>
				</span>
			</div>

           
		<div id="show_err"  class="alert alert-warning error-box" style="display:none;margin-top:10px;font-size:14px">
                
            </div>

            <div id="show_result" style="font-size:12px;">

            </div>
            
         

		</div>

			<div  class="row marketing">

			<div class="col-lg-6">
				<h4>服务状态<span>Service Stats</span></h4>

                <table style="font-size:12px" class="table table-hover">
                    <tr>
                        <th>version</th>
                        <td>0.0.1</td>
                    </tr>
                    <tr>
                        <th>PHP</th>
                        <td><?php echo phpversion();?></td>
                    </tr>
                    <tr>
                        <th>风格</th>
                        <td><body>
<a href="http://www.xn--est0ot47d.com/">翠绿
</a>
</body>
</html></td>
                    </tr>
               
                
                 
                </table>
			</div>
			
				<div class="col-lg-6">
				<h4>最新公告<span>Latest News</span></h4>
<div style="font-size:12px;"><?php echo $config['news'];?>
</div>
			</div>
		</div>
		

	</div>
<script>
function ajax_post(url, data, handle) {
	$.ajax({
		type: 'POST',
		url: url,
		data: "ajax=1&" + data,
		beforesend: function (xmlhttprequest) {
            xmlhttprequest.setrequestheader("request_type","ajax");
        },
		success: handle
	});
}

function get_scan() {
	$("#show_result").html('');
	var key =trim($("#key").val());  
	if (key == '') {
		$("#show_result").focus();
		$("#show_result").slideDown('fast', function(){
			$("#show_err").html("关键字不能为空~!");
			$("#show_err").show();
		});
		timer_slideToggle('#show_result', 'fast', 2500);
		return false;
	}
	if (key.length<1) {
		$("#show_result").focus();
		$("#show_result").slideDown('fast', function(){
			$("#show_err").html("关键字不能少于5位~!");
			$("#show_err").show();
		});
		timer_slideToggle('#show_result', 'fast', 2500);
		return false;
	}
	if (key) {
		$("#show_err").html("正在查询~~请耐心等待，您要的结果一定会出现！！");
		$("#show_err").show();
		$("#show_result").slideUp();
		var data = "q=" + encodeURI(encodeURI(key));
		ajax_post('index.php', data, function(data){
			$("#show_result").slideDown('fast', function(){
				$("#show_err").hide();
				$("#show_result").html(data);
			});
		});
	}
	return false;
}
function trim(str){ 
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
template.helper('$keyReplace', function (content) {
    return content.replace(keyword, '<code>'+keyword+'</code>')
});
</script>
<?php require_once("footer.php");?>
		
		
				
			