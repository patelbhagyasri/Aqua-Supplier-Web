<?php
include_once('../connection.php');
date_default_timezone_set("Asia/Calcutta"); 
$sql = "select empID,empName from tbl_employee where empID NOT IN (select empID from emp_attendance where at_date=CURDATE())";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('emp_id'=>$row[0],'emp_name'=>$row[1]));
}
echo json_encode(array("result"=>$result));


  
?>