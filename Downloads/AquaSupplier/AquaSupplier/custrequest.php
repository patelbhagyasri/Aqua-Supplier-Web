<?php
include_once('connection.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>

<?php 
		if(isset($_POST["id"]))
{
    $id = $_POST["id"];
   	
	$result=mysql_query("SELECT * FROM  customer_master WHERE cname='".$id."'");
	
	while($row=mysql_fetch_array($result))
	{
		$_SESSION['custid']=$row["cid"];
		$_SESSION['custname']=$row["cname"];
		$_SESSION['custcontact']=$row['ccontact'];
		$_SESSION['custaddres1']=$row['addline1'];
		$_SESSION['custaddres2']=$row['addline2'];
		$_SESSION['gst']=$row['gst'];
		/*if(strlen($row['gst'])==15)
		{ 
			$_SESSION['ses_invoice_type']="TAX Invoice";
		}
		else
		{
			$_SESSION['ses_invoice_type']="Retail Invoice";
		}*/
	
    } 
}
?>

</body>
</html>
