<?php
include_once('../connection.php');
$customerId=$_REQUEST['customer_id'];

$response = array();
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
$supply_qty="";
$dep_amt="";
$total_due="";
$old_due="";
$customer_id="";
$truck_id="";
$customer_name="";
$contact="";
$address="";
$plan="";
$result_name = mysql_query("select * from customer_master where customer_id='$customerId'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if (mysql_num_rows($result_name)>0) {
        // successfully inserted into database
		while($row=mysql_fetch_array($result_name))
		{
			$response["name"]=$row['customer_name'];
			$response["address"]=$row['customer_address'];
			$response["contact"]=$row['customer_contact'];
			$response["planname"]=$row['plan_name'];
			$response["rate"]=$row['plan_rate'];
			$response["amount"]=$row['amount'];
			
		}
        // echoing JSON response
    } 
	 $response["success"] = 1;
     $response["message"] = "Data received successfully";
	echo json_encode($response);

?>