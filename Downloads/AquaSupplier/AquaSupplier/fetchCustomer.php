<?php
//fetch.php
include('connection.php');
$request = mysql_real_escape_string($_POST["query"]);
$query = "
 SELECT * FROM customer_master WHERE cname LIKE '%".$request."%'
";

$result = mysql_query($query);

$data = array();

if(mysql_num_rows($result) > 0)
{
 while($row = mysql_fetch_assoc($result))
 {
  $data[] = $row["cname"];
 }
 echo json_encode($data);
}

?>