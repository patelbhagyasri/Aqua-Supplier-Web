

<?php
include_once('../connection.php');

$ex_name=$_POST['ex_name'];
$truck_no=$_POST['truck_no'];
$amount=$_POST['amount'];
$remark=$_POST['remark'];


date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)


mysql_query("set names utf8");
$getExId=mysql_query("select ex_id from tbl_expense where ex_name='$ex_name'");
while($row=mysql_fetch_array($getExId))
{
	$ex_id=$row[0];

}
mysql_query("set names utf8");
$getTruckId=mysql_query("select truck_id from truck_master where truck_number='$truck_no'");
while($row1=mysql_fetch_array($getTruckId))
{
	$truck_id=$row1[0];

}



mysql_query("set names utf8");
$check=mysql_query("insert into expense_statement (ex_id,ex_date,amount,remark,truck_id) values ('$ex_id',CURDATE(),'$amount','$remark','$truck_id')");
if($check>0){
echo $check;
}else{
echo '0';
}
?>
