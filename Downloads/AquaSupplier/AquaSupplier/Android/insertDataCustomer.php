<?php
include_once('../connection.php');
if (isset($_GET['customer_id']) && isset($_GET['supply_qty'])&& isset($_GET['return_qty'])&& isset($_GET['truck_id'])&& isset($_GET['total_amount'])) {
   $cust_id=$_GET['customer_id'];
$supply_qty=$_GET['supply_qty'];
$return_qty=$_GET['return_qty'];
$truck_id=$_GET['truck_id'];
$total_amount=$_GET['total_amount'];
$plan_rate=0;
    // include db connect clas
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d H:i:s');

$sql1="select sum(supplied_qty) from water_supply_master where truck_id ='$truck_id' AND supply_date=CURDATE() AND lt_id=(select max(lt_id) from load_truck where truck_id='$truck_id')";
$res1 = mysql_query($sql1);

while($row1 = mysql_fetch_array($res1)){
$qty=$row1[0];
}

$sql2 = "select sum(product_qty) from load_truck where truck_id ='$truck_id' AND load_date=CURDATE() AND lt_id=(select max(lt_id) from load_truck where truck_id='$truck_id')";
mysql_query("set names utf8");
$res2 = mysql_query($sql2);
 
while($row2 = mysql_fetch_array($res2)){
$qty_load=$row2[0];
}
$remain_qty=$qty_load-$qty;


mysql_query("set names utf8");
$gerplanRate=mysql_query("select plan_rate,plan_name from customer_master where customer_id='$cust_id'");
while($row=mysql_fetch_array($gerplanRate))
{
	$plan_rate=$row[0];
	$plan_name=$row[1];
}
mysql_query("set names utf8");
$getEmpID=mysql_query("select lt_id,empID from load_truck where truck_id='$truck_id' AND load_date=CURDATE()");
while($rowEmpID=mysql_fetch_array($getEmpID))
{
	$ltId=$rowEmpID[0];
	$empId=$rowEmpID[1];
}
if($supply_qty=="")
{
	$supply_qty=1;
}
if($return_qty=="")
{
	$return_qty=1;
}
if($supply_qty==0)
{
    $plan_rate=0;
}
$total_plan_rate=$plan_rate*$supply_qty;
if($remain_qty>0){
  mysql_query("set names utf8");
    // mysql inserting a new row
    $result = mysql_query("insert into water_supply_master (truck_id,customer_id,supply_date,supplied_qty,return_qty,plan_rate,deposit_amount,plan_name,lt_id,empID) values ('$truck_id','$cust_id','$curDate','$supply_qty','$return_qty','$total_plan_rate','$dep_amount','$plan_name','$ltId','$empId')");
	$result_amount = mysql_query("UPDATE customer_master SET amount='$total_amount' WHERE customer_id='$cust_id'");
}
    // check if row inserted or not
    if ($result&&$result_amount) {
		
		$result_name = mysql_query("select * from customer_master where customer_id='$cust_id'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if (mysql_num_rows($result_name)>0) {
        // successfully inserted into database
		while($row=mysql_fetch_array($result_name))
		{
			$response["amount"]=$row['amount'];
			
		}
        // echoing JSON response
    } 
		
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Customer Data Updated successfully.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>