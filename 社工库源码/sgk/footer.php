	<?php
if(!defined('IN_TM')) 
{
exit('Access Denied');
}
?>
	<div class="footer container">
		<p>
			友情链接  
			
			<?php	foreach ($link as $k => $v){echo '<a href="'.$v.'" title="'.$k.'" target="_blank">'.$k.'</a>';echo "&nbsp;";}?>
			
		</p>  
		<p>
			&copy; Company <?php echo $config['name'];?>
		</p>
	</div>
	
	
	</body>
</html>
<?php $mysql->close();?>