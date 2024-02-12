<?php
include_once('../connection.php');
//$areaId=$_REQUEST['area_id'];
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
$sql = "select sum(return_qty) from water_supply_master where truck_id ='".$_REQUEST['truck_id']."' AND supply_date='$curDate' AND lt_id=(select max(lt_id) from load_truck where truck_id='".$_REQUEST['truck_id']."')";
mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
	$result_name = mysql_query("SELECT SUM(ret_qty) AS Ret,SUM(amount) AS amt FROM `case_sell` WHERE `truck_id`='".$_REQUEST['truck_id']."' AND sell_date='$curDate'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if (mysql_num_rows($result_name)>0) {
        // successfully inserted into database
		while($rowemp=mysql_fetch_array($result_name))
		{
			
			$emp=$rowemp['Ret'];
			
		}
    }
array_push($result,
array('product_qty'=>$row[0]+$emp));
}
echo json_encode(array("resultEmpty"=>$result));
?>