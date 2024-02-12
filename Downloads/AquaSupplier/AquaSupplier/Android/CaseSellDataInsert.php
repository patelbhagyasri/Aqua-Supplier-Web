<?php
include_once('../connection.php');
if (isset($_GET['truck_id']) &&isset($_GET['sup_qty']) &&isset($_GET['ret_qty']) &&isset($_GET['amount']) ) {
$truck_id=$_GET['truck_id'];
$sup_qty=$_GET['sup_qty'];
$ret_qty=$_GET['ret_qty'];
$amount=$_GET['amount'];
$date=date("y-m-d");
    // check if row inserted or not


$result_name = mysql_query("insert into case_sell (sell_date,sup_qty,ret_qty,amount,truck_id) values ('$date','$sup_qty','$ret_qty','$amount','$truck_id')");
//$sqlGetCust = "select * from customer_master where customer_id='$customerId'";
if ($result_name) {
        // successfully inserted into database
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