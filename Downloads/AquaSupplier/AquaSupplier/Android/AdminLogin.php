<?php
include('../connection.php');
$username = $_POST['username'];
$password = $_POST['password'];
$res=mysql_query("select usl_id from universal_secure_login where usl_user='$username' and usl_password='$password'");
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