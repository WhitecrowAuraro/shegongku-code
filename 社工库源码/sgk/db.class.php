<?php
 class mysql
{
    private $host;
    private $user;
    private $pass;
    private $database;
    private $charset;
    function __construct($host,$user,$pass,$database,$charset)
    {
        $this->host=$host;
        $this->user=$user;
        $this->pass=$pass;
        $this->database=$database;
        $this->charset=$charset;
        $this->connect();
    }
    private function connect()//连接函数
    {
        mysql_connect($this->host,$this->user,$this->pass) or die ("连接数据库服务器失败!");
        mysql_select_db($this->database) or die ("连接数据库失败!");
        mysql_query("set names $this->charset");        
    }
    function select($sql,$tab,$col,$value)//选择函数
    {	
        $select=mysql_query("select $sql from $tab where $col=$value");
		//print_r("select $sql from $tab where $col=$value");
        $row=mysql_fetch_array($select);
        return $row;
    }
	
	function query($sql) {
		$data=Array();
			if ($query = mysql_query($sql)) {
				while ($_rows = mysql_fetch_array($query)) {
					$data[] = $_rows;
				}
				return $data;
			} else {
				return false;
			}
    }
	
	  function m($sql,$tab)//选择函数
    {
        $select=mysql_query("select $sql from $tab");
		print_r("select $sql from $tab LIMIT 0 , 999");
        $row=mysql_fetch_array($select);
        return $row;
    }
    function insert($tab,$col,$value)//插入数据函数
    {
        mysql_query("INSERT INTO $tab($col)values($value)");
    }
    function update($tab,$col,$new_value,$colm,$value)//更新数据函数
    {
        mysql_query("UPDATE $tab SET $col=$new_value where $colm=$value");    
    }
    function delete($tab,$col,$value)//删除数据函数
    {
        mysql_query("DELETE FROM $tab where $col=$value");
        }
    function close()//关闭连接函数
    {
    mysql_close();
    
    }
}

?>