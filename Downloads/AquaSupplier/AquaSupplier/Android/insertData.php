<?php
include_once('../connection.php');
if (isset($_GET['customer_id']) && isset($_GET['total_amount'])) {
   $cust_id=$_GET['customer_id'];
$total_amount=$_GET['total_amount'];

  $result = mysql_query("UPDATE customer_master SET amount='$total_amount' WHERE customer_id='$cust_id'");

    // check if row inserted or not
    if ($result) {
		$fatch_amount = mysql_query("select * from customer_master where customer_id='$cust_id'");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
		if (mysql_num_rows($fatch_amount)>0) {
        // successfully inserted into database
			while($row=mysql_fetch_array($fatch_amount))
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