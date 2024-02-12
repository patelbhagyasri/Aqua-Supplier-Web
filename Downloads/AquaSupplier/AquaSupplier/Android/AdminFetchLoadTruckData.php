<?php
include_once('../connection.php');

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d H:i:s');
$sql = "select lt_id,driver_name,product_qty from load_truck where load_date=CURDATE()";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('lt_id'=>$row[0],'driver_name'=>$row[1],'product_qty'=>$row[2]));
}
echo json_encode(array("result"=>$result));
?>