<?php
include_once('../connection.php');

$lt_id=$_POST['lt_id'];
$sql = mysql_query("delete from load_truck where lt_id='$lt_id'");
if($sql>0){
echo $sql;
}else{
echo '0';
}
 
?>