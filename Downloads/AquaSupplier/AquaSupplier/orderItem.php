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
						$orderTime=$rowFinal['orderTime'];
					}
	?>
        <div class="modal-header">
			<header class="w3-container w3-blue">
				
				<div class="w3-row">
					  <div class="w3-col m3 w3-center">
						<b style="font-size:25px;"><?php echo $name;?></b>
					  </div>
					  <div class="w3-col m2 w3-left">
						
						<a href="suppliedItem.php?invoiceID=<?php echo $_REQUEST['invoiceID'];  ?>" class="w3-button w3-red"  name="btnReturnProduct">Supplied Qty</a>
						
					  </div>
					  <div class="w3-col m2 w3-left">
						
						<a href="returnItem.php?invoiceID=<?php echo $_REQUEST['invoiceID'];  ?>" class="w3-button w3-light-blue"  name="btnReturnProduct">Return Qty</a>
						
					  </div>
					  
					   <div class="w3-col m2 w3-left">
						<?php
							if($orderStatus=="Pending")
							{
						?>
						<input type="submit" class="w3-button w3-light-blue"  name="btnConfirm" onclick="return confirm('Are You Sure?')" value="Confirm Order">
						<?php
							}
							else
							{
								?>
								<p type="submit" class="w3-button w3-green" value="" >Finish</p>
								<?php
							}
						?>
					  </div>
					  <div class="w3-col m3 w3-right">
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
						Invoice Date: <b style="font-size:15px;"><?php echo date('d-M-Y',strtotime($invoiceDate));?></b>
					  </div>
					  <div class="w3-col m3 w3-center">
						Order Date: <b style="font-size:15px;"><?php 
						$date = date('Y-m-d',strtotime($orderDate));
					$time =date('H:i:s',strtotime($orderTime));
					$DateTime = $date . " " . $time;

						//$timestamp = date('Y-m-d H:i:s',strtotime($DateTime));
						echo date('d-M-Y h:i:s A',strtotime($DateTime));
						
						
					
						?></b>
					  </div>
					</div>
			</header>
		
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		<div class="row">
	
		
		
		<div class="col-sm-12">
		<div class="w3-responsive">
		<div class="w3-responsive">
			<table class="w3-table-all w3-hoverable">
				<thead>
				  <tr class="w3-light-grey">
					<th>#</th>
					<th>Product</th>
					<th>Qty</th>
					
				  </tr>
				</thead>
				<?php
					mysql_query('set names utf8');
					$resTemp=mysql_query("select * from temp_invoice_supplied where invoice_id='".$_REQUEST['invoiceID']."'");
					while($rowTemp=mysql_fetch_array($resTemp))
					{
						?>
						<tr>
							  <td><?php echo ++$count; ?></td>
							  <td><?php echo $rowTemp['product_name'] ?></td>
							  <td><?php echo $rowTemp['product_qty'] ?></td>
							
							</tr>
						<?php
					}
				?>
				<?php
						mysql_query('set names utf8');
							$rrr=mysql_query("select sum(amount),sum(debit) from statement where invoice_id='$invoiceID'");
							
							while($fetchRow=mysql_fetch_array($rrr))
							{
								$totalDue=$fetchRow[0]-$fetchRow[1];
							}
						?>
						
				<?php
							mysql_query('set names utf8');
							
							$resDeposite=mysql_query("select sum(debit) from statement where invoice_id='".$_REQUEST['invoiceID']."' and remark='Deposite' and status='Paid'");
							
							while($rowDeposite=mysql_fetch_array($resDeposite))
							{
								$totalDeposite=$rowDeposite[0];
							}
							mysql_query('set names utf8');
							
							$resTotalDebit=mysql_query("select sum(debit),sum(amount),sum(credit) from statement where invoice_id='".$_REQUEST['invoiceID']."'");
							
							while($rowTotalDebit=mysql_fetch_array($resTotalDebit))
							{
								$totalDebit=$rowTotalDebit[0];
								$totalSum=$rowTotalDebit[1];
								$totalCredit=$rowTotalDebit[2];
							}
						?>
						
						
			 </table>
			 </div>
			 <div class="w3-center" style="margin-top:5px;">
			 <div class="w3-container">
				  <div class="w3-bar">
					 <button class="w3-button w3-black"> Invoice Amt : <?php echo $totalSum; ?></button>
					  <button class="w3-button w3-black"> Deposite Amt : <?php echo $totalDeposite; ?> </button>
					 
					  <button class="w3-button w3-black"> Debit : <?php echo $totalDebit; ?></button>
					  
					  <button class="w3-button w3-black"> Total Due: <?php echo $totalDue; ?></button>
					  
					  <a href="?editinvoiceID=<?php echo $_REQUEST['invoiceID']; ?>&invoiceDate=<?php echo $orderDate; ?>" class="w3-button w3-round-large w3-deep-purple" onclick="return confirm('Are You Sure?')"> <i class="glyphicon glyphicon-pencil"></i> Edit Order</a>
					  <a href="editOrderInfo.php?invoiceID=<?php echo $_REQUEST['invoiceID']; ?>" class="w3-button w3-round-large  w3-light-green" onclick="return confirm('Are You Sure?')"> <i class="glyphicon glyphicon-pencil"></i> Edit Order Info</a>
					<a href="printBOSOrder.php?invoiceID=<?php echo $_REQUEST['invoiceID']; ?>" class="w3-button w3-round-large w3-red"> <i class="glyphicon glyphicon-print" style="color:white;"></i> </a>
					</div> 
				  
					
			</div>
			</div>
				
				<div class="col-sm-12">
					<div class="w3-responsive">
					<div class="w3-center w3-panel w3-topbar w3-bottombar w3-border-red w3-pale-red" style="margin-top:5px;">
						Return Product
					
					<table class="w3-table-all w3-hoverable w3-small">
				<thead>
				  <tr class="w3-light-grey">
					<th>#</th>
					<th>Product</th>
					
					<th>Supplied Time</th>
					<th>Supplied Qty</th>
					<th>Retrun Qty</th>
					<th>Remaining Qty</th>
					<th>Retrun Time</th>
				  </tr>
				</thead>
				<?php
					mysql_query('set names utf8');
					$resTempSupplied=mysql_query("select product_name,sum(product_qty) from temp_invoice where invoice_id='".$_REQUEST['invoiceID']."' group by product_name");
					while($rowTempSupplied=mysql_fetch_array($resTempSupplied))
					{
							mysql_query('set names utf8');
							$resTempReturn=mysql_query("select product_name,sum(product_qty) from temp_invoice_return where invoice_id='".$_REQUEST['invoiceID']."' and product_name='$rowTempSupplied[0]'");
						
							while($rowTempReturn=mysql_fetch_array($resTempReturn))
							{
								$returnQty=$rowTempReturn[1];
							}
							?>
								<tr>
									  <td><?php echo ++$count1; ?></td>
									  <td><?php echo $rowTempSupplied[0]; ?></td>
									  
									   <td><?php 
									   mysql_query('set names utf8');
										$resSuppliedTime=mysql_query("select orderTime,product_qty from temp_invoice where invoice_id='".$_REQUEST['invoiceID']."' and product_name='$rowTempSupplied[0]'");
						
											while($rowSuppliedTime=mysql_fetch_array($resSuppliedTime))
											{
												echo date('d-M-Y h:i A',strtotime($rowSuppliedTime[0]))." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class='w3-text-blue'>Supplied QTY: ".$rowSuppliedTime[1]."</b><br>";
											}

									  ?></td>
									  <td><?php echo $rowTempSupplied[1]; ?></td>
									  <td><?php echo $returnQty; ?></td>
									  <td><?php echo $rowTempSupplied[1]-$returnQty; ?></td>
									  <td><?php 
									  mysql_query('set names utf8');
										$resReturnTime=mysql_query("select returnTime,product_qty from temp_invoice_return where invoice_id='".$_REQUEST['invoiceID']."' and product_name='$rowTempSupplied[0]'");
						
											while($rowRetrunTime=mysql_fetch_array($resReturnTime))
											{
												echo date('d-M-Y h:i A',strtotime($rowRetrunTime[0]))." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class='w3-text-red'>Return QTY: ".$rowRetrunTime[1]."</b><br>";
											}

									  ?></td>
									 
									  
									</tr>
						<?php
					}
					mysql_query('set names utf8');
					$resTempSuppliedCheck=mysql_query("select * from temp_invoice where invoice_id='".$_REQUEST['invoiceID']."'");
					$countSupplied=mysql_num_rows($resTempSuppliedCheck);
					if($countSupplied>0)
					{
					
					}
					else
					{
						?>
							<tr>
							  <td colspan="7"><center><b class="w3-text-red">Product Qty Not Supplied!!</b></center></td>
							 
							</tr>
					<?php
					}
					mysql_query('set names utf8');
					$resTempReturnCheck=mysql_query("select * from temp_invoice_return where invoice_id='".$_REQUEST['invoiceID']."'");
					$countReturn=mysql_num_rows($resTempReturnCheck);
					if($countReturn>0)
					{
					
					}
					else
					{
						?>
							<tr>
							  <td colspan="7"><center><b class="w3-text-blue">Product Qty Not Retrun!!</b></center></td>
							 
							</tr>
					<?php
					}
			
						if($orderStatus=="Pending")
							{
								?>
							<tr>
							  <td colspan="7"><center><b class="w3-text-red">Order Is Pending!!</b></center></td>
							 
							 
							  
							</tr>
						<?php
							}
				?>
				
			 </table>
				</div>
				</div>
				</div>
				
				<div class="col-sm-12">
				<div class="w3-responsive">
					<div class="w3-center w3-panel w3-topbar w3-bottombar w3-border-green w3-pale-green" style="margin-top:5px;">
						Order Statement
					
					<table class="w3-table-all w3-hoverable w3-small">
											<tr>
												<th>Bill No</th>
												<th>Name</th>
												
												<th>Contact</th>
												<th>Address</th>
												<th>Date</th>
												<th>Bill Amount</th>
												<th>Credit</th>
												<th>Debit</th>
												<th>Remark</th>
												<th>Status</th>
												<th>Action</th>
												
											</tr>
											
												<?php
													mysql_query('set names utf8');
												$resStatement1=mysql_query("select ge.invoice_id,ge.cname,ge.ccontact,ge.address1,st.st_date,st.amount,st.credit,st.debit,st.remark,st.status,st.st_id from generate_invoice ge,statement st where ge.invoice_id=st.invoice_id and st.invoice_id='".$_REQUEST['invoiceID']."'");				
												while($rowStP=mysql_fetch_array($resStatement1))
												{
												?>
													
												
														
													<tr>
													<td><?php echo $rowStP[0]; ?></td>
													<td><?php echo $rowStP[1]; ?></td>							
													<td><?php echo $rowStP[2]; ?></td>
													<td><?php echo $rowStP[3]; ?></td>
													<td><?php echo date('d-M-Y',strtotime($rowStP[4])); ?></td>
													<td><?php echo $rowStP[5]; ?></td>
													<td><?php echo $rowStP[6]; ?></td>
													<td><?php echo $rowStP[7]; ?></td>
													<td><?php echo $rowStP[8]; ?></td>
													<td><?php echo $rowStP[9]; ?></td>
													<td><center><a href="?deleteID=<?php echo $rowStP[10]; ?>&invoiceID=<?php echo $_REQUEST['invoiceID']; ?>" onClick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"></i> </a></center></td>
														
													
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
				
				if(isset($_REQUEST['btnConfirm']))
				{
					mysql_query("update final_invoice set order_status='Delieved' where invoice_id='".$_REQUEST['invoiceID']."'");
					echo "<script>window.location='orderItem.php?invoiceID=$_REQUEST[invoiceID]'</script>";
				}
				
			?>
			<?php
				if(isset($_REQUEST['deleteID']))
				{
					mysql_query("delete from statement where st_id='".$_REQUEST['deleteID']."'");
					echo "<script>window.location='orderItem.php?invoiceID=$_REQUEST[invoiceID]'</script>";
				}
			?>			
</div>
</div>

	
</form>	
</body>
</html>