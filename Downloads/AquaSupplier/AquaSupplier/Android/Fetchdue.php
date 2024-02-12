<?php
include_once('../connection.php');
//$areaId=$_REQUEST['area_id'];
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
$supply_qty="";
$dep_amt="";
$total_due="";
$old_due="";

$year=date('Y',strtotime('1-'.$curDate));
$sql = "select sum(supplied_qty),sum(plan_rate) from water_supply_master where customer_id ='".$_REQUEST['customer_id']."' AND MONTH(supply_date)=MONTH(CURDATE())";
mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
$supply_qty=$row[0];
$dep_amt=$row[1];
}

$getSum = "select sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id ='".$_REQUEST['customer_id']."' AND MONTH(supply_date)!=MONTH(CURDATE())";
$resGetsum=mysql_query($getSum);

while($rowGetSum=mysql_fetch_array($resGetsum))
{
	$old_due=$rowGetSum[0]-$rowGetSum[1];
}
$total_due=$old_due+$dep_amt;
array_push($result,
array('supplied_qty'=>$supply_qty,'rec_amt'=>$dep_amt,'old_due'=>$old_due,'total_due'=>$total_due));
echo json_encode(array("resultQty"=>$result));
?>