<?php
include_once('../connection.php');
mysql_query("set names utf8"); 
$userID=$_REQUEST['user_id']; 
$sql = "select * from customer_master where customer_id='$userID'";
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('Name'=>$row[1],'Address'=>$row[3],'Contact'=>$row[2],'plan'=>$row[13]));
}

echo json_encode(array("result"=>$result));
?>