<?php
include_once('../connection.php');
$sql = "select * from truck_master";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('truck_id'=>$row[0],'truck_name'=>$row[1]));
}
echo json_encode(array("result"=>$result));

$sql1 = "select empName from tbl_employee where designation='Driver'";
  mysql_query("set names utf8");
$res1 = mysql_query($sql1);
$result1 = array(); 
while($row1 = mysql_fetch_array($res1)){
array_push($result1,
array('Driver_name'=>$row1[0]));
}
echo json_encode(array("result1"=>$result1));
?>