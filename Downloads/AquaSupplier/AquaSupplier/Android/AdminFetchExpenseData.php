<?php
include_once('../connection.php');
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$sql = "select es.ex_st_id,e.ex_name,es.amount,es.remark from expense_statement es,tbl_expense e where e.ex_id=es.ex_id AND es.ex_date=CURDATE()";
  mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
array_push($result,
array('ex_id'=>$row[0],'ex_name'=>$row[1],'ex_amt'=>$row[2],'ex_remark'=>$row[3]));
}
echo json_encode(array("result"=>$result));


  
?>