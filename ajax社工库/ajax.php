<?php
	session_start();
	error_reporting(0);
	header("Content-type: text/html; charset=utf-8");
	require "config.php";
	@date_default_timezone_set(PRC);
	set_time_limit(0); 
	@ob_end_clean();
	ob_implicit_flush(true);
	switch($_GET['act']){
		case "database":
			if(empty($_SESSION['member'])){
				exit('var database=new Array("login");');
			}
			$connect_db = mysql_connect($dbnhost, $dbnuser, $dbnpass);
			$select_db = mysql_select_db($dbname, $connect_db);
			mysql_query("SET NAMES 'UTF8'");
			mysql_query("SET CHARACTER SET UTF8");
	        mysql_query("SET CHARACTER_SET_RESULTS=UTF8");
			$rs = mysql_query("SHOW TABLES FROM $dbname");
			$tables = array();
			while ($row = mysql_fetch_row($rs)) {
				$tables[] = $row[0];
			}
			mysql_free_result($rs);
			$array_tj=count($tables);
			$count=1;
			$text="";
			foreach($tables as  $key=>$tableName){
				if($key==count($tables)-1){
					$dian="";
				}else{
					$dian=",";
				}
				$text=$text.'"'.$tableName.'"'.$dian;
				$count++;
			}
		echo "var database = new Array($text);";	
		break;
		case "select":
			if(empty($_SESSION['member'])){
					echo "cnrv_msg(\"请登录\");addRow(\"登录后查询\",\"登录后查询\",\"登录后查询\",\"登录后查询\");";
					exit;
					
			}
			$select_act=(int)addslashes(trim($_POST['select_act']));
			$match_act=(int)addslashes(trim($_POST['match_act']));
			$key=addslashes(trim($_POST['key']));
			$table=addslashes(trim($_POST['table']));
				if(empty($key) || $key==''){exit("请输入查询内容");}
				if(strlen($key)<4){exit("key length!!!");}
				
					$key = str_replace("_","\_",$key);
					$key = str_replace("%","\%",$key);
						switch($match_act){
							case 2:$key = '=\''.$key.'\'';break;
							case 1:$key = ' like \''.$key.'%\'';break;
							default:exit("SB");
						}
						switch($select_act){//查询方式
							case 1:$limits="username".$key;break;
							case 2:$limits="email".$key;break;
							case 3:$limits="username".$key."or email".$key;break;
							default:exit("SB");
						}
						    $connect_db = mysql_connect($dbnhost, $dbnuser, $dbnpass);
							$select_db = mysql_select_db($dbname, $connect_db);
							mysql_query("SET NAMES 'UTF8'");
							mysql_query("SET CHARACTER SET UTF8");
	                        mysql_query("SET CHARACTER_SET_RESULTS=UTF8");
						$sql="select $Field  from `$table` where $limits LIMIT 30";
						require "database.php";
							$databasename=database($table);
							if($result=mysql_query($sql)){
								while($rows=mysql_fetch_assoc($result)){
										$username= mysql_real_escape_string($rows['username']);
										$email= mysql_real_escape_string($rows['email']);
										$password= mysql_real_escape_string($rows['password']);
										echo "addRow(\"$username\",\"$email\",\"$password\",\"$databasename\");";
								}// end while
							}
					
		
		
		
		break;
		default:print_r("SB");
	}
	