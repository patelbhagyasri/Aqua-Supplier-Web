<?php
include_once('../connection.php');
$cust_id=$_POST['customer_id'];
$truck_id=$_POST['truck_id'];

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d H:i:s');

  mysql_query("set names utf8");
$check=mysql_query("insert into temp_master (truck_id,customer_id,supply_date) values ('$truck_id','$cust_id','$curDate')");
if($check>0){
echo $check;
}else{
echo '0';
}  

?>