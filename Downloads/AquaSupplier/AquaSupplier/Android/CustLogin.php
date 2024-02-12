<?php
include('../connection.php');
// check for required fields
if (isset($_GET['Username']) && isset($_GET['password'])) {
    
	$username=$_GET['Username'];
	$password=$_GET['password'];
	
    // mysql inserting a new row
    $result = mysql_query("select customer_id from customer_master where customer_name='$username' and customer_contact='$password'");

    // check if row inserted or not
    if (mysql_num_rows($result)>0) {
        // successfully inserted into database
		while($row=mysql_fetch_array($result))
		{
			$response["success"] = 1;
			$response["message"] =$row['customer_id'];
		}
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! Invalid Login.";
        
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