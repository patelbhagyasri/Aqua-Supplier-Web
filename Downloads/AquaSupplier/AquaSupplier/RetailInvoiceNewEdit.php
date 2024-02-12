<?php
include_once('connection.php');
date_default_timezone_set("Asia/Calcutta"); 
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Retail Invoice</title>
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
 
});
</script>
		
	<script>
	$(document).ready(function()
	{
		$(document).keyup(function( event ) {
			if ( event.which==27) {
			  window.location = "newmenu.php";
		  }
		});
	 });
</script>

<script>
$(document).ready(function(){
 
 $('#country').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetchProduct.php",
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
    $( "#purchase_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  
});
</script>


</head>

<body onkeydown="keyCode(event)">
<?php
	include('sidebarHeader.php');
?>

<div id="main" style="margin-left:200px">
	
<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
		
         <p style="color:#000; font-weight:bold;font-size:17px;">Update Order Invoice</p>
        
			<form method="post" name="f2" id="f2">
		<?php 
			if($_SESSION['ses_invoice_id_rt_edit']!=null)
			{
		?>
		<div class="row">
		<div class="col-sm-4">
		Product Name
		<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>		
			<!--<input type="text" name="country" id="country" class="form-control input-sm" autocomplete="off" placeholder="Product Name" tabindex="4" required />-->
			<input type="text" name="txt_product_name" id="txt_product_name" class="form-control input-sm" autofocus autocomplete="off" placeholder="Product Name" tabindex="4" required />
		</div>
		</div>
	
				
			<div class="col-sm-2">
				Order Qty
				<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-minus-sign"></i></span>
					<input type="text" class="form-control input-sm" name="txtBox" id="txtBox" placeholder="Qty" tabindex="9" required />
				</div>
				</div>	
			<div class="col-sm-1">
				<br>
						<button type="submit" class="btn btn-primary" id="btnaddtocart" name="btnaddtocart" tabindex="10"><span class="badge" style="color:red;"><span class="glyphicon glyphicon-download-alt"></span></button>
						
				</div>
		</div>	
		<br>
		<div class="row">
		
		</div>
		
		
		
		<?php
		}
		?>
		</div>
		
		
		<div class="modal-body" style="padding:10px 10px;">
		
			<center> <b>Invoice No : <?php echo $_SESSION['ses_invoice_id_rt_edit']; ?> </b></center>
						<div class="scrollable">
						<table class="table table-fixed table-bordered">
							<thead>
							<tr>
								<th>Sr.No</th>
								<th>Particular</th>
								
								<th>Order Qty</th>
								
								<th><center>Delete</center></th>
							</tr>
							</thead>
						
					<?php	
						
						if(isset($_POST["btnaddtocart"]))
						{
						
						
							
									$qty=$_POST['txtBox'];
									
							
							if($qty>0)
								{
									/*$Time = $_POST['txtTime'];
									$Date = $_POST['txtDate'];
									$DateTime = $Date . " " . $Time;*/

									$timestamp = date('Y-m-d H:i:s');
									
									//$t = date('Y-m-d H:i:s',time());
									mysql_query('set names utf8');
								mysql_query("insert into temp_invoice_supplied(invoice_id,product_name,product_qty,returnTime) 
								VALUES ('".$_SESSION['ses_invoice_id_rt_edit']."','".$_POST["txt_product_name"]."','$qty','$timestamp')");	
								}
							
						}
							mysql_query('set names utf8');
					$resTemp=mysql_query("select * from temp_invoice_supplied where invoice_id='".$_SESSION['ses_invoice_id_rt_edit']."'");
					while($rowTemp=mysql_fetch_array($resTemp))
					{
						?>
						<tr>
							  <td><?php echo ++$count; ?></td>
							  <td><?php echo $rowTemp['product_name'] ?></td>
							  <td><?php echo $rowTemp['product_qty'] ?></td>
							 <td><center><a href='?delid=<?php echo $rowTemp['temp_invoice_id_return'];?>' onClick="return confirm('Do You Want To Delete ?')"><span style="color:red;" class="glyphicon glyphicon-trash"></span></a></center></td>
							</tr>
						<?php
					}
					?>
				</table>
				</div>
				</form>
				<form method="POST" name="f4" id="f4">
		<br>
			<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-5">
				
			<div class="btn-group btn-group-justified">
				
				<div class="btn-group">
				  <input type="submit" name="btnSave" id="btnSave" class="btn btn-success pull-right" value="Save Order" tabindex="15" />
				</div>
				
			  </div>

			
			</div>
			<div class="col-sm-12">
			
				
			
				
				<?php
					
					if(isset($_POST['btnSave']))
					{	
								unset($_SESSION['ses_invoice_id_rt_edit']);
								unset($_SESSION['ses_invoice_date_edit']);
								
							echo "<script>window.location='home.php'</script>";
						
					}
				?>
				
				<?php
					
					
					if(isset($_REQUEST['delid']))
				{
					mysql_query("delete from temp_invoice_supplied where temp_invoice_id_return='".$_REQUEST['delid']."'");
					echo "<script>window.location='RetailInvoiceNewEdit.php'</script>";
				}
				?>
			</div>
		</div>
		

</div>
	
	
	


</div>



</div>

</div>
</div>




</form>

</body>
</html>
