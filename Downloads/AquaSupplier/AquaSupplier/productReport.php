<?php
include_once('connection.php');
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<link href="bootstrap/css/font.css" rel="stylesheet"> 
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
 <script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script>
	<style>
		.mar{
		margin-top:20px;
		}
	</style>	   

</head>

<body onkeydown="keyCode(event)">

<?php
include('menu.php');
?>

<form name="insert" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
<div class="container mar">
<div class="panel panel-info">
			  <div class="panel-heading"> Product Report
		
			  </div>
			  <div class="panel-body">
			  <div class="row">
				<div class="col-sm-4">
					<table class="table">
					<tr>
						<th>Product Name</th>
						<th>Available Qty</th>						
					</tr>
					<tbody>
						<?php
							$result=mysql_query("select product_id,product_name,product_qty from product_master order by product_id");
							while($row=mysql_fetch_array($result))
							{
						?>
						<tr>
								<td><?php echo $row[1]; ?></td>
								<td><?php echo $row[2]; ?></td>
								
						</tr>
						<?php
							}
						
						?>
					</tbody>
				</table>
				
				</div>
				<div class="col-sm-4">
					<table class="table">
					<tr>
						
						<th>Purchase Qty</th>
						
					</tr>
					<tbody>
						<?php
							$result=mysql_query("select product_id,sum(product_qty) from purchase_product group by product_id order by product_id");
							while($row=mysql_fetch_array($result))
							{
						?>
						<tr>
								
								<td><?php echo $row[1]; ?></td>
								
								
								
						</tr>
						<?php
							}
						
						?>
					</tbody>
				</table>
				</div>
				<div class="col-sm-4">
					<table class="table">
					<tr>
						
						<th>Sell Qty</th>
						
					</tr>
					<tbody>
						<?php
							$result=mysql_query("select product_id,sum(product_qty) from temp_invoice group by product_id order by product_id");
							while($row=mysql_fetch_array($result))
							{
						?>
						<tr>
								<td><?php echo $row[1]; ?></td>
								
								
								
								
						</tr>
						<?php
							}
						
						?>
					</tbody>
				</table>
				</div>
			  </div>
				
				
				
				
				</div>
			</div>
	</div>		
			</form>

</body>
</html>