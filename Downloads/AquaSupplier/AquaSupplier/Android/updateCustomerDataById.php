<?php
include_once('../connection.php');
if (isset($_GET['customer_id']) && isset($_GET['planname'])&& isset($_GET['rate'])) {
    
	$customer_id=$_GET['customer_id'];
	$planname=$_GET['planname'];
	$rate=$_GET['rate'];
    // include db connect clas

    // mysql inserting a new row
    $result = mysql_query("UPDATE customer_master SET plan_name='$planname',plan_rate='$rate' WHERE customer_id='$customer_id'");

    // check if row inserted or not
    if ($result) {
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