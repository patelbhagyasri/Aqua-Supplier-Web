<?php
include_once('../connection.php');
$customerId=$_REQUEST['customer_id'];
$truck_id=$_REQUEST['truck_id'];

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
$supply_qty="";
$dep_amt="";
$total_due="";
$old_due="";
$customer_id="";

$customer_name="";
$contact="";
$address="";
$plan="";

$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
mysql_query("set names utf8");
$resGetCust = mysql_query($sqlGetCust);
$result = array(); 
while($rowGetCust = mysql_fetch_array($resGetCust)){

$customer_id=$rowGetCust[0];
//$truck_id=$rowGetCust[4];
$customer_name=$rowGetCust[1];
$contact=$rowGetCust[2];
$address=$rowGetCust[3];
$plan=$rowGetCust[13];
}


$year=date('Y',strtotime('1-'.$curDate));
$sql = "select sum(supplied_qty),sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id ='".$_REQUEST['customer_id']."' AND supply_date=CURDATE() AND truck_id='$truck_id'";
mysql_query("set names utf8");
$res = mysql_query($sql);

while($row = mysql_fetch_array($res)){
$supply_qty=$row[0];
$dep_amt=$row[2];
}

array_push($result,
array('customer_id'=>$customer_id,'truck_id'=>$truck_id,'customer_name'=>$customer_name,'contact'=>$contact,'address'=>$address,'supplied_qty'=>$supply_qty,'rec_amt'=>$dep_amt));


echo json_encode(array("result"=>$result));
?>