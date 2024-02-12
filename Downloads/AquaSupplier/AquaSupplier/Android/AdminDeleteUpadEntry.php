<?php
include_once('../connection.php');

$up_id=$_POST['up_id'];
$sql = mysql_query("delete from emp_upad where emp_up_id='$up_id'");
if($sql>0){
echo $sql;
}else{
echo '0';
}
 
?>