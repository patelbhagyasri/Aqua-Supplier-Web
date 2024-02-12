<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include_once('connection.php');
date_default_timezone_set("Asia/Calcutta");

if (!isset($_SESSION['name'])) {
	echo "<script>window.location='index.php'</script>";	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add New Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<style>
		.mar{
		margin-top:20px;
		}
		input{
		
    text-transform: uppercase;

		}
	</style>
	<style>
@media screen and (max-width: 455px) {
    .h3 {
        font-size:16px;
    }
}

.modal-header, .close {
      background-color:#bce8f1 !important;
    
     
  }
</style>
	<style>
		.mar{
		margin-top:20px;
		}
		input{
		
    text-transform: uppercase;

		}
	</style>

<script>
$(document).ready(function(){
 
   $( function() {
    $( "#txtOrderDate" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  
});
</script>
</head>
<body style="background:#e6e6e6;color:black;">
<?php
	include('sidebarHeader.php');
?>

<form action="" method="POST">
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">

		<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
	<?php
					$result=mysql_query("select * from generate_invoice where invoice_id='".$_REQUEST['invoiceID']."'");
					while($row=mysql_fetch_array($result))
					{
						$name=$row['cname'];
						$contact=$row['ccontact'];
						$address=$row['address1'];
						$invoiceDate=$row['invoice_date'];
						$orderDate=$row['order_date'];
						$invoiceID=$row['invoice_id'];
					}
					$resFinal=mysql_query("select * from final_invoice where invoice_id='".$_REQUEST['invoiceID']."'");
					while($rowFinal=mysql_fetch_array($resFinal))
					{
						$orderStatus=$rowFinal['order_status'];
					}
	?>
        <div class="modal-header">
			<b style="font-size:25xp;">Edit Info</b>
			<header class="w3-container w3-blue">
				
				<div class="w3-row">
						<div class="w3-col m1 w3-left">
						
						<a href="orderItem.php?invoiceID=<?php echo $_REQUEST['invoiceID'];  ?>" class="w3-button w3-light-blue"  name="btnBack">Back</a>
						
					  </div>
					  <div class="w3-col m8 w3-center">
						<b style="font-size:25px;"><?php echo $name;?></b>
					  </div>
					  
					  <div class="w3-col m3 w3-right">
						invoice No: <b style="font-size:15px;"><?php echo $invoiceID;?></b>
					  </div>
					 
					</div>
				<hr>
				  
				  <div class="w3-row">
					<div class="w3-col m3">
						
						<label class="w3-text-white"><b>Name</b></label>
						<input class="form-control" type="text" name="txtName" value="<?php echo $name; ?>">
					  </div>
					  <div class="w3-col m3">
						
						<label class="w3-text-white"><b>Address</b></label>
						<input class="form-control" type="text" name="txtAddress" value="<?php echo $address; ?>">
					  </div>
					  <div class="w3-col m2">
						
						<label class="w3-text-white"><b>Contact No</b></label>
						<input class="form-control" type="text" name="txtContact" value="<?php echo $contact; ?>">
					  </div>
					 
					  <div class="w3-col m2">
						<label class="w3-text-white"><b>Order Date</b></label>
						<input class="form-control" type="text" name="txtOrderDate" id="txtOrderDate" value="<?php echo $orderDate; ?>">
					  </div>
					  <div class="w3-col m2 w3-center">
						<br>
						<input type="submit" class="w3-button w3-indigo" type="text" value="Update Info" name="btnUpdateRecord">
					  </div>
					</div>
					<hr>
			</header>
			<?php
				if(isset($_POST['btnUpdateRecord']))
				{
					
					mysql_query("update generate_invoice set cname='".strtoupper($_POST['txtName'])."',ccontact='".$_POST['txtContact']."',address1='".strtoupper($_POST['txtAddress'])."',
					order_date='".date('Y-m-d',strtotime($_POST['txtOrderDate']))."' where invoice_id='".$_REQUEST['invoiceID']."'");
					mysql_query("update final_invoice set order_date='".date('Y-m-d',strtotime($_POST['txtOrderDate']))."' where invoice_id='".$_REQUEST['invoiceID']."'");
					
					echo "<script>window.location='editOrderInfo.php?invoiceID=$_REQUEST[invoiceID]'</script>";
				}
			?>
        </div>
		
		</div>
      </div>
		
</div>
</div>

	
</form>	
</body>
</html>