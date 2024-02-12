
<?php
include_once('../connection.php');

$emp_name=$_POST['emp_name'];
$upad_amt=$_POST['upad_amt'];



date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)


mysql_query("set names utf8");
$getEmpId=mysql_query("select empID from tbl_employee where empName='$emp_name'");
while($row=mysql_fetch_array($getEmpId))
{
	$emp_id=$row[0];

}




mysql_query("set names utf8");
$check=mysql_query("insert into emp_upad (empID,upadAmount,upad_date) values ('$emp_id','$upad_amt',CURDATE())");
if($check>0){
echo $check;
}else{
echo '0';
}
?>
