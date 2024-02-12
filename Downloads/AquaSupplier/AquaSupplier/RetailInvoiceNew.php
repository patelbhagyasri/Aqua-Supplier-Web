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
<form method="post" name="f1" id="f1">
<div id="main" style="margin-left:200px">
	
<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
		<?php
		//unset($_SESSION['ses_invoice_id_rt']);
		?>
         <p style="color:#000; font-weight:bold;font-size:17px;">Order Invoice</p>
        <div class="row">
			<div class="col-sm-3"
			 <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Customer Name</b>
				 <input type="text" name="custName" id="custName" class="form-control" autofocus autocomplete="off" placeholder="Customer Name" tabindex="1" required />
			
			</div>
			<div class="col-sm-3" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Address</b>
				 <input type="text" name="custAddress" id="custAddress" class="form-control" autocomplete="off" placeholder="Address" tabindex="2" required />
			
			</div>
			<div class="col-sm-2" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Contact</b>
				 <input type="text" name="custContact" id="custContact" class="form-control" autocomplete="off" placeholder="Contact" tabindex="3" />
			
			</div>
			<div class="col-sm-2">
				<div class="input-group" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Order Date</b>
				<input type="text" class="form-control " data-field="date" id="purchase_date" name="purchase_date" placeholder="Date" tabindex="4" <?php if($_SESSION['ses_invoice_id_rt']!="")
									{
											?>style="display:none;"<?php
									} ?>  />
			</div>
			</div>
			<div class="col-sm-2"<?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
							<b>Order Time</b>
							<div class="input-group bootstrap-timepicker timepicker">
                <input id="txtTime" name="txtTime" type="text" class="form-control" tabindex="5">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
            </div>
		
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
			<div class="col-sm-2"<?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
							<br>
							
							
				<button type="submit" class="btn btn-success pull-left" id="btnSave" name="btnSave" value="Save" tabindex="6" > <span class="badge"><span class="glyphicon glyphicon-ok"></span></span> Save Bill</button>
		
			</div>
			
				<?php
				if($_POST['purchase_date']!="")
				{
				if(isset($_POST['btnSave']))
				{
					
					// ---------  Code To Generate Invoice Number -----------------------------
					
					$result=mysql_query("select MAX(invoice_id) from generate_invoice");
					while($row=mysql_fetch_array($result))
					{
						$_SESSION['ses_invoice_id_rt']=$row[0]+1;
						
					}
					$Time = $_POST['txtTime'];
					$Date = $_POST['purchase_date'];
					$DateTime = $Date . " " . $Time;

					$timestamp = date('Y-m-d H:i:s',strtotime($DateTime));
					
					$get_date=$_POST['purchase_date'];
					$set_date=strtotime($get_date);
					$_SESSION['ses_date_order']=date('Y-m-d',$set_date);
					$_SESSION['ses_invoice_date']=date('Y-m-d');
					
					$_SESSION['ses_invoice_order_time']=$timestamp;
					
					$_SESSION['ses_less_per']=$_POST['txtRate'];
					$_SESSION['ses_customer_name']=$_POST['custName'];
					$_SESSION['ses_invoice_type_rt']="Retail Invoice";
					
					// ---------  Code To Insert Data Into Generate Invoice Table ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
					
					$i=mysql_query("insert into generate_invoice(invoice_id,cname,ccontact,address1,invoice_date,order_date,orderTime) values 
					('".$_SESSION['ses_invoice_id_rt']."','".strtoupper($_POST['custName'])."','".$_POST['custContact']."',
					'".strtoupper($_POST['custAddress'])."','".$_SESSION['ses_invoice_date']."','".$_SESSION['ses_date_order']."','".$_SESSION['ses_invoice_order_time']."')");
					if ( $i > 0 )
						{
							
							echo "<script>window.location='RetailInvoiceNew.php'</script>";
							
						}	
					else
						{
							echo "<script>window.location='RetailInvoiceNew.php'</script>";
					
						}
				 
					

				


					
					// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
					
					
				}
				}
			?>
		</div>
		</form>
			<form method="post" name="f2" id="f2">
		<?php 
			if($_SESSION['ses_invoice_id_rt']!=null)
			{
		?>
		<div class="row">
		<div class="col-sm-4">
		<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>		
			<!--<input type="text" name="country" id="country" class="form-control input-sm" autocomplete="off" placeholder="Product Name" tabindex="4" required />-->
			<input type="text" name="txt_product_name" id="txt_product_name" class="form-control input-sm" autocomplete="off" autofocus placeholder="Product Name" tabindex="4" required />
		</div>
		</div>
				
			<div class="col-sm-2">
				<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-minus-sign"></i></span>
					<input type="text" class="form-control input-sm" name="txtBox" id="txtBox" placeholder="Qty" tabindex="9" required />
				</div>
				</div>	
			<div class="col-sm-1">
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
		
			<center> <b>Invoice No : <?php echo $_SESSION['ses_invoice_id_rt']; ?> - <?php echo $_SESSION['custname']; ?> </b></center>
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
						
						
							
									
							/*if($rate>0)
								{
								mysql_query("insert into temp_invoice(invoice_id,product_name,product_rate,uom,product_qty,amount,invoice_date,invoice_type) 
								VALUES ('".$_SESSION['ses_invoice_id_rt']."','".$_POST["txt_product_name"]."','$rate','LTR','$qty','$totalRate',
								'".$_SESSION['ses_invoice_date']."','".$_SESSION['ses_invoice_type_rt']."')");	
								}	*/
							 
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
								VALUES ('".$_SESSION['ses_invoice_id_rt']."','".$_POST["txt_product_name"]."','$qty','$timestamp')");	
								}
							
							
						}
						
					mysql_query('set names utf8');
					$resTemp=mysql_query("select * from temp_invoice_supplied where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
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
					<form method="post" name="f3" id="f3">
				
			<div class="row">
			<div class="col-sm-6">
			</div>
			<div class="col-sm-2">
						<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-minus-sign"></i></span>
						<input type="text" name="txtDeposite" class="form-control" placeholder="Deposite" tabindex="14" />
						</div>
						</div>
			<div class="col-sm-2">
							
				<input type="submit" name="btnDelete" id="btnDelete" class="btn btn-danger pull-right" value="Delete This Bill" tabindex="16" />
							
			</div>
			<div class="col-sm-2">
				
			<div class="btn-group btn-group-justified">
				
				<!--<div class="btn-group">
				  <input type="submit" name="btnCash" id="btnCash" class="btn btn-success pull-right" value="Cash Bill" tabindex="15" />
				</div>-->
				<div class="btn-group">
				  <input type="submit" name="btnCredit" id="btnCredit" class="btn btn-info pull-right" value="Save Order" tabindex="16" />
				</div>
				
			  </div>

			
			</div>
			<div class="col-sm-12">
			
				
			
				
				<?php
					/*if(isset($_POST['btnCash']))
					{	$resultsum=mysql_query("select sum(amount) from temp_invoice where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
						while($row1=mysql_fetch_array($resultsum))
						{
							$total_amount=$row1[0];
							
						}
						if($total_amount!=0)
						{
							
							$net_amt=($total_amount);
							mysql_query("insert into final_invoice(invoice_id,amount,invoice_type,net_amount,invoice_date,order_status,order_date,orderTime) values 
							('".$_SESSION['ses_invoice_id_rt']."','$total_amount','".$_SESSION['ses_invoice_type_rt']."','$net_amt','".$_SESSION['ses_invoice_date']."'
							,'Pending','".$_SESSION['ses_date_order']."','".$_SESSION['ses_invoice_order_time']."')");
							mysql_query("insert into statement(invoice_id,amount,credit,debit,st_date,remark,status) values('".$_SESSION['ses_invoice_id_rt']."','$net_amt','0','$net_amt','".$_SESSION['ses_invoice_date']."','Cash Bill','Paid')");
							
							//--------Deposite Amt------------//
							$depositeAmt=$_POST['txtDeposite'];
							if($depositeAmt>0)
							{
								mysql_query("insert into statement(invoice_id,debit,st_date,remark,status) values
								('".$_SESSION['ses_invoice_id_rt']."','$depositeAmt','".$_SESSION['ses_invoice_date']."','Deposite','Paid')");
							}
							echo "<script>window.location='printBOSOrder.php?invoiceID=$_SESSION[ses_invoice_id_rt]'</script>";
							
							//header('location:printBOS.php?bill_id='.$_SESSION['ses_invoice_id_rt'].'&bill_type='.$_SESSION['ses_invoice_type_rt']);
							
						}
						else
						{
							echo "<script>window.location='RetailInvoiceNew.php?</script>";
						}
					}*/
				?>
				
				<?php
					if(isset($_POST['btnCredit']))
					{	
					
							$net_amt=($total_amount);
							mysql_query("insert into final_invoice (invoice_id,amount,invoice_type,net_amount,invoice_date,order_status,order_date,orderTime) values 
							('".$_SESSION['ses_invoice_id_rt']."','$total_amount','".$_SESSION['ses_invoice_type_rt']."','$net_amt','".$_SESSION['ses_invoice_date']."'
							,'Pending','".$_SESSION['ses_date_order']."','".$_SESSION['ses_invoice_order_time']."')");
							mysql_query("insert into statement(invoice_id,amount,credit,debit,st_date,remark,status) values('".$_SESSION['ses_invoice_id_rt']."','$net_amt','$net_amt','0','".$_SESSION['ses_invoice_date']."','Credit Bill','Unpaid')");
							//--------Deposite Amt------------//
							$depositeAmt=$_POST['txtDeposite'];
							if($depositeAmt>0)
							{
								mysql_query("insert into statement(invoice_id,debit,st_date,remark,status) values
								('".$_SESSION['ses_invoice_id_rt']."','$depositeAmt','".$_SESSION['ses_invoice_date']."','Deposite','Paid')");
							}
								//echo "<script>window.location='printBOSOrder.php?invoiceID=$_SESSION[ses_invoice_id_rt]'</script>";
								unset($_SESSION['ses_invoice_id_rt']);
								unset($_SESSION['ses_date_order']);
								unset($_SESSION['ses_invoice_date']);						
								unset($_SESSION['ses_invoice_type_rt']);
					
							echo "<script>window.location='RetailInvoiceNew.php'</script>";
						
					}
				?>
			</div>
		</div>
		
		
	
<?php
			
			if(isset($_REQUEST['delid']))
				{
					mysql_query("delete from temp_invoice_supplied where temp_invoice_id_return='".$_REQUEST['delid']."'");
					echo "<script>window.location='RetailInvoiceNew.php'</script>";
				}
			
			if(isset($_POST['btnDelete']))
			{
				mysql_query("delete from final_invoice where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					mysql_query("delete from generate_invoice where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					mysql_query("delete from temp_invoice where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					mysql_query("delete from statement where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					mysql_query("delete from temp_invoice_supplied where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					mysql_query("delete from  temp_invoice_return where invoice_id='".$_SESSION['ses_invoice_id_rt']."'");
					unset($_SESSION['ses_invoice_id_rt']);
					unset($_SESSION['ses_date_order']);
					unset($_SESSION['ses_invoice_date']);						
					unset($_SESSION['ses_invoice_type_rt']);
					echo "<script>window.location='RetailInvoiceNew.php'</script>";
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
