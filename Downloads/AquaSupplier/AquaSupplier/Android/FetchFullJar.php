<?php
include_once('../connection.php');
//$areaId=$_REQUEST['area_id'];
$curDate= date('Y-m-d');
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
$qty=0;
$qty_load=0;
$remain_qty=0;
$sql1="select sum(supplied_qty) from water_supply_master where truck_id ='".$_REQUEST['truck_id']."' AND supply_date=CURDATE() AND lt_id=(select max(lt_id) from load_truck where truck_id='".$_REQUEST['truck_id']."')";
$res1 = mysql_query($sql1);

while($row1 = mysql_fetch_array($res1)){
$qty=$row1[0];
}

$sql = "select sum(product_qty) from load_truck where truck_id ='".$_REQUEST['truck_id']."' AND load_date=CURDATE() AND lt_id=(select max(lt_id) from load_truck where truck_id='".$_REQUEST['truck_id']."')";
mysql_query("set names utf8");
$res = mysql_query($sql);
$result = array(); 
while($row = mysql_fetch_array($res)){
$qty_load=$row[0];
}
$result_name = mysql_query("SELECT SUM(sup_qty) AS Sup,SUM(amount) AS amt FROM `case_sell` WHERE `truck_id`='".$_REQUEST['truck_id']."' AND sell_date='$curDate'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if (mysql_num_rows($result_name)>0) {
        // successfully inserted into database
		while($row=mysql_fetch_array($result_name))
		{
			
			$cash=$row['Sup'];
			
			
		}
    }
$remain_qty=$qty_load-$qty-$cash;
array_push($result,
array('product_qty'=>$remain_qty));
echo json_encode(array("resultQty"=>$result));
?>

