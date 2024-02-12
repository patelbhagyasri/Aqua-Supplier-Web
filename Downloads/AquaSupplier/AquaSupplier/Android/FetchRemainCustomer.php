<?php

$truckId=$_REQUEST['truck_id'];
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');

?>

<?php 
include"../dbclass.php";
$db = new db();
?>

	<?php 
	$result = array(); 
	
	 $data_lists = $db->select('customer_master',"where truck_id='$truckId' AND customer_id NOT IN (select DISTINCT customer_id from water_supply_master where supply_date='$curDate') AND customer_id IN (select DISTINCT customer_id from temp_master where supply_date='$curDate') order by position_order asc");
	 foreach($data_lists as $data_list){
	 array_push($result,
		array('customer_id'=>$data_list[0],'truck_id'=>$data_list[4],'customer_name'=>$data_list[1],'contact'=>$data_list[7],'address'=>$data_list[3]));
	 }
		echo json_encode(array("result"=>$result));
	 ?>

