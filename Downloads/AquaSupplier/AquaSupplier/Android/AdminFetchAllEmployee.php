<?php
include_once('../connection.php');
$sql = "select empName from tbl_employee";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('Driver_name'=>$row[0]));
}
echo json_encode(array("result"=>$result));


  
?>