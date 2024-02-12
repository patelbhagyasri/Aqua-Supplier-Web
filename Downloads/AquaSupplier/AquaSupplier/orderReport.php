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
	<script src="bootstrap/js/bootstrap3-typeahead.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">	
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

<script type="text/javascript">
	
     $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#txtStartDate" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
  
     $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#txtEndDate" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
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
		
		
         <p style="color:#000; font-weight:bold;font-size:17px;">Pending Order Report</p>
		
		
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		<div class="row">
	
		
		<div class="col-sm-12">
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
		<thead>
		<tr class="danger">
			<th>#</th>
			<th>Customer Name</th>
			<th>Conatct</th>
			<th>Address</th>
			<th>Order Date</th>
			<th>Amount</th>
						
			<th><center>Action</center></th>
		</tr>
		</thead>
		<?php
			
					$count=1;
					mysql_query("set names utf8");
					
				
					$result=mysql_query("select gi.invoice_id,gi.cname,gi.ccontact,gi.address1,gi.order_date,fi.net_amount,fi.order_status,gi.invoice_date from  final_invoice fi,generate_invoice gi where fi.invoice_id=gi.invoice_id and fi.order_status='Pending'");
					while($row=mysql_fetch_array($result))
					{
					
						?>
							<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo date('d-M-Y',strtotime($row[4])); ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><center><a href="?editinvoiceID=<?php echo $row[0]; ?>&invoiceDate=<?php echo $row[7] ?>" class="btn btn-sm btn-warning" onclick="return confirm('Are You Sure?')"> <i class="glyphicon glyphicon-pencil"></i> </a> | <a href="printBOSOrder.php?invoiceID=<?php echo $row[0]; ?>" class="btn btn-sm btn-info"> <i class="glyphicon glyphicon-print"></i> </a> | <a href="orderItem.php?invoiceID=<?php echo $row[0]; ?>" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-eye-open"></i> </a> | <a href="?deleteID=<?php echo $row[0]; ?>" onClick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"></i> </a></center></td>	
				</tr>
						<?php
					}
			
		?>	
			</table>
		</div>
		</div>
		</div>
      </div>
		<?php
				if(isset($_REQUEST['editinvoiceID']))
				{
					$_SESSION['ses_invoice_id_rt_edit']=$_REQUEST['editinvoiceID'];
					$_SESSION['ses_invoice_date_edit']=$_REQUEST['invoiceDate'];
					echo "<script>window.location='RetailInvoiceNewEdit.php'</script>";
				}
				
				if(isset($_REQUEST['deleteID']))
				{
					mysql_query("delete from final_invoice where invoice_id='".$_REQUEST['deleteID']."'");
					mysql_query("delete from generate_invoice where invoice_id='".$_REQUEST['deleteID']."'");
					mysql_query("delete from temp_invoice where invoice_id='".$_REQUEST['deleteID']."'");
					mysql_query("delete from statement where invoice_id='".$_REQUEST['deleteID']."'");
					mysql_query("delete from temp_invoice_supplied where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					mysql_query("delete from  temp_invoice_return where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					echo "<script>window.location='orderReport.php'</script>";
				}
			?>	
</div>
</div>

	
</form>	
</body>
</html>