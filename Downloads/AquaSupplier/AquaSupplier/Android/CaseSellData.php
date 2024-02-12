<?php
include_once('../connection.php');
if (isset($_GET['truck_id'])) {
$truck_id=$_GET['truck_id'];
 $result = mysql_query("");
$date=date("y-m-d");
    // check if row inserted or not


$result_name = mysql_query("SELECT SUM(sup_qty) AS Sup,SUM(amount) AS amt FROM `case_sell` WHERE `truck_id`='$truck_id' AND sell_date='$date'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if (mysql_num_rows($result_name)>0) {
        // successfully inserted into database
		while($row=mysql_fetch_array($result_name))
		{
			
			$response["Sup"]=$row['Sup'];
			$response["amt"]=$row['amt'];
			
		}
        // echoing JSON response
		 $response["success"] = 1;
        $response["message"] = "Customer Data Updated successfully.";
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