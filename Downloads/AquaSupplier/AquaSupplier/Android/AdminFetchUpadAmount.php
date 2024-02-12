<?php
include_once('../connection.php');

$emp_name=$_REQUEST['emp_name'];

	$result1=mysql_query("select sum(salaryAmount) from emp_attendance where empID=(select empID from tbl_employee where empName='$emp_name')");
					
					while($row1=mysql_fetch_array($result1))
					{
						$amt=$row1[0];
					}
	$result2=mysql_query("select sum(upadAmount) from emp_upad where empID=(select empID from tbl_employee where empName='$emp_name')");
					
					while($row2=mysql_fetch_array($result2))
					{
						$upad_amt=$row2[0];
					}

$result = array();
$total_amt=$amt-$upad_amt;
array_push($result,
array('amount'=>$total_amt));
echo json_encode(array("result"=>$result));


 
?>