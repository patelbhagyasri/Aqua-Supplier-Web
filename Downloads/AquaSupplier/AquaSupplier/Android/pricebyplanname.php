<?php
include_once('../connection.php');
$plan_id=$_REQUEST['plan_id'];

$result_price = mysql_query("SELECT plan_rate FROM plan_master WHERE plan_id='$plan_id'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if (mysql_num_rows($result_price)>0) {
        // successfully inserted into database
		while($row=mysql_fetch_array($result_price))
		{
		
			$response["rate"]=$row['plan_rate'];
		
		}
	
        // echoing JSON response
    } 
	 $response["success"] = 1;
     $response["message"] = "Data received successfully";
	echo json_encode($response);

?>