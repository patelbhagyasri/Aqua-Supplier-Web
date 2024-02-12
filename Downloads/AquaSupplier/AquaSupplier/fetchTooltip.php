<?php
include('connection.php');
if(isset($_POST['id']))
{

	$output='';
	  mysql_query("set names utf8");
	$res=mysql_query("select * from customer_master where customer_id='".$_POST['id']."'");
	while($row=mysql_fetch_array($res))
	{
		$output='
		<p>Name : '.$row[1].'</p>
		<p>Contact : '.$row[2].'</p>
		<p>Address : '.$row[3].'</p>
		
		';
	}
	echo $output;
}
?>