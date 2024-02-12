<?php
include_once('../connection.php');
//$areaId=$_REQUEST['area_id'];
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
$sql = "select product_name,product_qty from load_truck where truck_id ='".$_REQUEST['truck_id']."' AND load_date='$curDate'";
mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('product_name'=>$row[0],'product_qty'=>$row[1]));
}
echo json_encode(array("result"=>$result));
?>