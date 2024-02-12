
			
			
			<?php
header('Content-type: application/json; charset=UTF-8');
$response = array();
 
if ($_POST['delete']) {
 
    require_once 'connection.php';
 
    $pid = intval($_POST['delete']);
    $query = "delete from product_master where product_id=$pid";
	$stmt=mysql_query($query);
     
    
    if ($stmt) {
        $response['status']  = 'success';
 $response['message'] = 'Product Deleted Successfully ...';
    } else {
        $response['status']  = 'error';
 $response['message'] = 'Unable to delete Product ...';
    }
    echo json_encode($response);
}