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
	
	<link type="text/css" href="bootstrap/css/bootstrap-timepicker.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap-timepicker.min.js"></script>
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
<script>
$(document).ready(function(){
 
 $('#txt_product_name').typeahead({
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
 $( function() {
    $( "#txtDate" ).datepicker({
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
					mysql_query('set names utf8');
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
					mysql_query('set names utf8');
					$resFinal=mysql_query("select * from final_invoice where invoice_id='".$_REQUEST['invoiceID']."'");
					while($rowFinal=mysql_fetch_array($resFinal))
					{
						$orderStatus=$rowFinal['order_status'];
					}
	?>
        <div class="modal-header">
			<header class="w3-container w3-blue text-center">
				
				<div class="w3-row">
					 <div class="w3-col m2 w3-left">
						
						<a href="orderItem.php?invoiceID=<?php echo $_REQUEST['invoiceID'];  ?>" class="w3-button w3-light-blue"  name="btnBack">Back</a>
						
					  </div>
					  <div class="w3-col m7 w3-center">
						<b style="font-size:25px;"><?php echo $name;?></b>
					  </div>
					  
					  <div class="w3-col m3 w3-center">
						invoice No: <b style="font-size:15px;"><?php echo $invoiceID;?></b>
					  </div>
					 
					</div>
				<hr>
				  
				  <div class="w3-row">
					  <div class="w3-col m3 w3-center">
						Address:<b style="font-size:15px;"><?php echo $address;?></b>
					  </div>
					  <div class="w3-col m3 w3-center">
						Contact No: <b style="font-size:15px;"><?php echo $contact;?></b>
					  </div>
					  <div class="w3-col m3 w3-center">
						Invoice Date: <b style="font-size:15px;"><?php echo $invoiceDate;?></b>
					  </div>
					  <div class="w3-col m3 w3-center">
						Order Date: <b style="font-size:15px;"><?php echo $orderDate;?></b>
					  </div>
					</div>
			</header>
			<div class="w3-row">
			<br>
			<form name="f1" id="f1" method="POST">
				<div class="row">
		<div class="col-sm-4">
			Product Name
		<div class="input-group">
					
					  <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>		
			<!--<input type="text" name="country" id="country" class="form-control input-sm" autocomplete="off" placeholder="Product Name" tabindex="4" required />-->
			<input type="text" name="txt_product_name" id="txt_product_name" autofocus class="form-control input-sm" autocomplete="off" placeholder="Product Name" tabindex="1" required />
		</div>
		</div>
			
		<div class="col-sm-2">
				Return Qty
				<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-minus-sign"></i></span>
					<input type="text" class="form-control input-sm" name="txtBox" id="txtBox" placeholder="Qty" tabindex="2" required />
				</div>
		</div>
		<div class="col-sm-2">
				Return Date
				<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					<input type="text" class="form-control input-sm" name="txtDate" id="txtDate" value="<?php echo date('d-m-Y'); ?>"  placeholder="Return Date" tabindex="3" required />
				</div>
		</div>
			<div class="col-sm-2">
				Return Time
				<div class="input-group bootstrap-timepicker timepicker">
                <input id="txtTime" name="txtTime" type="text" class="form-control" tabindex="4">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
				 <script type="text/javascript">
                $('#txtTime').timepicker();
				            /*$('#txtTime').timepicker({
                minuteStep: 1,
                template: 'modal',
                appendWidgetTo: 'body',
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });*/
            </script>
            </div>
		</div>		
			<div class="col-sm-1">
					<br>
						<button type="submit" class="btn btn-primary" id="btnaddtocart" name="btnaddtocart" tabindex="5"><span class="badge" style="color:red;"> Add <span class="glyphicon glyphicon-download-alt"></span> </button>
						<?php
						if(isset($_POST["btnaddtocart"]))
						{
						
						
							
									
									$qty=$_POST['txtBox'];
									
							
							if($qty>0)
								{
									$Time = $_POST['txtTime'];
									$Date = $_POST['txtDate'];
									$DateTime = $Date . " " . $Time;

									$timestamp = date('Y-m-d H:i:s',strtotime($DateTime));
									
									//$t = date('Y-m-d H:i:s',time());
									mysql_query('set names utf8');
								mysql_query("insert into temp_invoice_return(invoice_id,product_name,product_qty,returnTime) 
								VALUES ('".$_REQUEST['invoiceID']."','".$_POST["txt_product_name"]."','$qty','$timestamp')");	
								}	
							 echo "<script>window.location='returnItem.php?invoiceID=$_REQUEST[invoiceID]'</script>";
							
							
							
						}
						?>
				</div>
			</form>
		</div>
			</div>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		<div class="row">
	
		
		
		<div class="col-sm-12">
		<div class="w3-responsive">
			<table class="w3-table-all w3-hoverable">
				<thead>
				  <tr class="w3-light-grey">
					<th>#</th>
					<th>Product</th>
					<th>Qty</th>
					<th>Action</th>
					
				  </tr>
				</thead>
				<?php
				mysql_query('set names utf8');
					$resTemp=mysql_query("select * from temp_invoice_return where invoice_id='".$_REQUEST['invoiceID']."'");
					while($rowTemp=mysql_fetch_array($resTemp))
					{
						?>
						<tr>
							  <td><?php echo ++$count; ?></td>
							  <td><?php echo $rowTemp['product_name'] ?></td>
							  <td><?php echo $rowTemp['product_qty'] ?></td>
							 <td><center><a href='?delid=<?php echo $rowTemp['temp_invoice_id_return'];?>&invoiceID=<?php echo $_REQUEST['invoiceID']; ?>' onClick="return confirm('Do You Want To Delete ?')"><span style="color:red;" class="glyphicon glyphicon-trash"></span></a></center></td>
							</tr>
						<?php
					}
				?>
				
			 </table>
			
			
			</div>
		</div>
		</div>
		</div>
		</div>
      </div>
		<?php
				
				if(isset($_REQUEST['btnBack']))
				{
					//mysql_query("update final_invoice set order_status='Delieved' where invoice_id='".$_REQUEST['invoiceID']."'");
					echo "<script>window.location='orderItem.php?invoiceID=$_REQUEST[invoiceID]'</script>";
				}
				
			?>
			<?php
				if(isset($_REQUEST['delid']))
				{
					mysql_query("delete from temp_invoice_return where temp_invoice_id_return='".$_REQUEST['delid']."'");
					echo "<script>window.location='returnItem.php?invoiceID=$_REQUEST[invoiceID]'</script>";
				}
			?>			
</div>
</div>

	
</form>	
</body>
</html>