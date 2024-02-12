<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

date_default_timezone_set("Asia/Calcutta");
include_once('connection.php');

if (!isset($_SESSION['name'])) {
	//header('location:index.php');
	echo "<script>window.location='index.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add Order</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="bootstrap/js/bootstrap3-typeahead.min.js"></script> 
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
 $(document).ready(function()
	{
		  
		
$(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#txtOrderDate" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
		
	});
</script>


<script>
$(document).ready(function(){
 $('#txtPlanName').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetchPlanName.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
	
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
	  
   })
  }

 });
 
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
        <div class="modal-header">
		<?php
			$result=mysql_query("select * from tbl_order where orderID='".$_REQUEST['orderid']."'");
			while($row=mysql_fetch_array($result))
			{
				$customer_name=$row['customer_name'];
				$contact_no=$row['contact_no'];
				$address=$row['address'];
				$orderDate=$row['orderDate'];
				$dateofOrder=$row['dateofOrder'];
				$plan_name=$row['plan_name'];
				$qty=$row['qty'];
				$rate=$row['rate'];
			}
		?>
		
         <p style="color:#000; font-weight:bold;font-size:17px;">Edit Order</p>
		 <div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					  <b>Customer Name</b>
					<input type="text" name="txtCustName" id="txtCustName" class="form-control input-sm" value="<?php echo $customer_name; ?>" placeholder="Customer Name" required tabindex="1"/>
			</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					  <b>Address</b>
					<input type="text" name="txtAddress" id="txtAddress" class="form-control input-sm" value="<?php echo $address; ?>" placeholder="Address" tabindex="1"/>
			</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					  <b>Contact</b>
					<input type="text" name="txtContact" id="txtContact" class="form-control input-sm" maxlength="13" value="<?php echo $contact_no; ?>" placeholder="Contact No" tabindex="1"/>
			</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					  <b>Order Date</b>
					<input type="text" name="txtOrderDate" id="txtOrderDate" class="form-control input-sm" value="<?php echo $orderDate; ?>" placeholder="Order Date" tabindex="1"/>
			</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					  <b>Plan Name</b>
					<input type="text" name="txtPlanName" id="txtPlanName" class="form-control input-sm" value="<?php echo $plan_name; ?>" placeholder="Plan Name" tabindex="1"/>
			</div>
			</div>
			</div>
			
			<div class="row">
			
			<div class="col-sm-1">
				<div class="form-group">
					  <b>Qty</b>
					<input type="text" name="txtQty" id="txtQty" class="form-control input-sm" placeholder="Qty" value="<?php echo $qty; ?>" tabindex="1"/>
			</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					  <b>Plan Rate</b>
					<input type="text" name="txtPlanRate" id="txtPlanRate" class="form-control input-sm" value="<?php echo $rate; ?>" placeholder="Plan Rate" tabindex="1"/>
			</div>
			</div>
			<div class="col-sm-2">
				<div class="form-group">
					<br>
					<button type="submit" class="btn btn-primary" name="btnProduct" id="btnProduct" tabindex="10"><span class="glyphicon glyphicon-pencil"></span> Update Order</button>
						   
				</div> 
			</div>
			</div>
			<div class="row">
				<?php
				if(isset($_POST['btnProduct']))
				{
					mysql_query("set names utf8");
					
					$orderDate=date('Y-m-d',strtotime($_POST['txtOrderDate']));
					$totalRate=$_POST['txtPlanRate']*$_POST['txtQty'];
					$today=date('Y-m-d');
				
					$i=mysql_query("update tbl_order set customer_name='".strtoupper($_POST['txtCustName'])."',contact_no='".$_POST['txtContact']."',address='".$_POST['txtAddress']."',
					orderDate='$orderDate',plan_name='".$_POST['txtPlanName']."',qty='".$_POST['txtQty']."',rate='".$_POST['txtPlanRate']."',total_rate='$totalRate'");
					if($i>0)
					{
						echo "<script>window.location='order.php'</script>";
					}
					else
					{
										echo "<div class='alert alert-danger'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>Error !!</strong>";
										echo"</div>";
					}
				}
			  ?>	
			</div>
        </div>
			 
		
		<div class="modal-body" style="padding:10px 10px;">
		
		</div>
      </div>

</div>
</div>

	
<script>
$(document).ready(function(){
	$('#productData').DataTable();
});
</script>
</form>	
</body>
</html>