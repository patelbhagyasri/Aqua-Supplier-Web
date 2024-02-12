
			
			
			<?php
header('Content-type: application/json; charset=UTF-8');
$response = array();
 
if ($_POST['delete']) {
 
    require_once 'connection.php';
 
    $pid = intval($_POST['delete']);
    $query = "delete from load_truck where lt_id=$pid";
	$stmt=mysql_query($query);
     
    
    if ($stmt) {
        $response['status']  = 'success';
 $response['message'] = 'Load Truck Deleted Successfully ...';
    } else {
        $response['status']  = 'error';
 $response['message'] = 'Unable to delete ...';
    }
    echo json_encode($response);
}