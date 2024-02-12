<?php
include_once('../connection.php');
$driver_name=$_POST['driver_name'];
$truck_no=$_POST['truck_no'];
$load_qty=$_POST['load_qty'];
$truck_id="";
$empId="";
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d H:i:s');


$getTruckId=mysql_query("select truck_id from truck_master where truck_number='$truck_no'");
while($row=mysql_fetch_array($getTruckId))
{
	$truck_id=$row[0];

}

$getEmpID=mysql_query("select empID from tbl_employee where empName='$driver_name'");
while($rowEmpID=mysql_fetch_array($getEmpID))
{

	$empId=$rowEmpID[0];
}


$check=mysql_query("insert into load_truck (truck_id,driver_name,product_qty,load_date,empID) values ('$truck_id','$driver_name','$load_qty',CURDATE(),'$empId')");
if($check>0){
echo $check;
}else{
echo '0';
}
?>