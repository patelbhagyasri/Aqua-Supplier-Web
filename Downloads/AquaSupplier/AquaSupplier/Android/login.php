<?php
include('../connection.php');
$username = $_POST['etTruckNo'];
$password = $_POST['password'];
$res=mysql_query("select truck_id from truck_master where truck_number='$username' and password='$password'");
$check = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
	$id=$row[0];
}
if($check >= 1){
echo $id;
}else{
echo '0';
}

?>