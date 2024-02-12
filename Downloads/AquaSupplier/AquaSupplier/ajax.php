<?php 
include"dbclass.php";
$db = new db();
$position = $_POST['position'];
$i=1;
foreach($position as $k=>$v){
	$data = array(
	    "position_order"=>$i
	);
	
	$db->update("customer_master",$data,"where customer_id='".$v."'");
	
	$i++;
}

?>