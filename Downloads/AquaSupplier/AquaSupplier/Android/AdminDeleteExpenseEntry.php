<?php
include_once('../connection.php');

$ex_id=$_POST['ex_id'];
$sql = mysql_query("delete from expense_statement where ex_st_id='$ex_id'");
if($sql>0){
echo $sql;
}else{
echo '0';
}
 
?>