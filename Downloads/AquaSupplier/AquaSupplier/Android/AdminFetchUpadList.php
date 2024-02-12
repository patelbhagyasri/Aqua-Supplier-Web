<?php
include_once('../connection.php');
$sql = "select u.emp_up_id,e.empName,u.upadAmount from tbl_employee e,emp_upad u where u.empId=e.empID AND u.upad_date=CURDATE()";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('up_id'=>$row[0],'emp_name'=>$row[1],'up_amount'=>$row[2]));
}
echo json_encode(array("result"=>$result));

  
?>