<?php
include_once('../connection.php');
$sql = "select * from tbl_expense";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('ex_name'=>$row[1]));
}
echo json_encode(array("result"=>$result));


?>