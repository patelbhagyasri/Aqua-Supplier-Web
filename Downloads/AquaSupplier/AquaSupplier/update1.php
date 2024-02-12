<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>update truck info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
		$result=mysql_query("select * from order_info");
		while($row=mysql_fetch_array($result))
		{
			$cust_name=$row[1];
			$plan=$row[2];
			$quantity=$row[3];
			$plan_rate=$row[4];
			$date=$row[5];
		}
?>
<div class="container">
<div class="row" style="margin-top:80px;">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8 well">
	<form method="POST">
		<center><label for="name"> UPDATE ORDER INFO </label></center> </br> 
	<div class="input-group">	<span class="input-group-addon"> <b>Customer Name</b> </span>		
	<input type="text" name="txtname" value="<?php echo $cust_name; ?>" class="form-control" placeholder="Enter customer name"/> </div> <br>
	<div class="input-group">	<span class="input-group-addon"> <b>Plan Name</b> </span>
	<input type="text" name="txtplan" value="<?php echo $plan; ?>" class="form-control" placeholder="Enter Password"/> </div> <br>
	<div class="input-group">	<span class="input-group-addon"> <b>Quantity</b> </span>		
	<input type="text" name="txtqty" value="<?php echo $quantity; ?>" class="form-control" placeholder="Enter Truck No"/> </div> <br>
	<div class="input-group">	<span class="input-group-addon"> <b>Plan Rate</b> </span>		
	<input type="text" name="txtprate" value="<?php echo $plan_rate; ?>" class="form-control" placeholder="Enter Truck No"/> </div> <br>
	<div class="input-group">	<span class="input-group-addon"> <b>Order date</b> </span>		
	<input type="text" name="txtdate" value="<?php echo $date; ?>" class="form-control" placeholder="Enter Truck No"/> </div> <br>
	<center> <button type="submit" class="btn btn-success" name="Update">Update</button> </center></br>
  <?php
	if(isset($_POST['Update']))
	{
		$name=$_POST['txtname'];
		$plan1=$_POST['txtplan'];
		$qty=$_POST['txtqty'];
		$prate=$_POST['txtprate'];
		$d1=$_POST['txtdate'];
		$i=mysql_query("update order_info set cust_name='$name',plan_name='$plan1',qty='$qty',plan_rate='$prate',order_date='$d1' where order_id='".$_REQUEST['id']."'");
		if($i>0)
		{
			echo "Success";
			//header('location:order_info.php');
			echo "<script>window.location='order_info.php'</script>";
		}
		else
		{
			echo "Fail";
		}
	}
  ?>
 
	
</form>
	</div>
	<div class="col-sm-2">
	</div>
</div>

</div>

</body>
</html>