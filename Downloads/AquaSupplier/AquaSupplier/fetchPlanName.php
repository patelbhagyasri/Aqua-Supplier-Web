<?php
//fetch.php
include('connection.php');
$request = mysql_real_escape_string($_POST["query"]);
$query = "
 SELECT * FROM plan_master WHERE plan_name LIKE '%".$request."%'
";
	mysql_query("set names utf8");
$result = mysql_query($query);

$data = array();

if(mysql_num_rows($result) > 0)
{
 while($row = mysql_fetch_assoc($result))
 {
  $data[] = $row["plan_name"];
 }
 echo json_encode($data);
}

?>