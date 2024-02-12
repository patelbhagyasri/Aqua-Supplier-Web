<?php
include_once('../connection.php');
$emp_id=$_POST['emp_id'];

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)



$getEmpSalary=mysql_query("select salaryAmount from tbl_employee where empID='$emp_id'");
while($row=mysql_fetch_array($getEmpSalary))
{
	$emp_salary=$row[0];

}




$check=mysql_query("insert into emp_attendance (empID,at_date,salaryAmount) values ('$emp_id',CURDATE(),'$emp_salary')");
if($check>0){
echo $check;
}else{
echo '0';
}
?>