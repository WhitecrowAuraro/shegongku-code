<?php

if(!defined('IN_TM')) 
{
exit('Access Denied');
}


?>

<?php require_once("header.php");?>

<h1>查询记录</h1>
	<div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>查询内容</th>
            <th>查询时间</th>
          </tr>
        </thead>
        <tbody>
		<?php         $datalog = $mysql->query("select * from scanlog where name='".$_SESSION['name']."' ORDER BY `id` DESC LIMIT 0 , 100"); //选择数据

				foreach($datalog as $val){
		?>
          <tr>
            <td><?php echo $val['id'];?></td>
            <td><?php echo $val['word'];?></td>
            <td><?php echo $val['time'];?></td>
          </tr>
		  <?php } ?>
        </tbody>
      </table>
    </div>
	  
	  <?php require_once("footer.php");?>