<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include_once('connection.php');

if (!isset($_SESSION['name'])) {
	echo "<script>window.location='index.php'</script>";	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Star Enterprise" />
<meta name="author" content="Star Enterprise" />
<link rel="stylesheet" href="bootstrap/css/w3.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
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
	<script>
 $(document).ready(function()
	{
		$('#selCom').focus();
		
		$( "#selCom").keypress(function( event ) {
		  if ( event.which == 13) {
			 $('#btnSearch').focus();
			return false;
		  }
		
		});		
		
	});
</script>

	<script type="text/javascript">
$(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#start_date" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
  
     $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#end_date" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
</script>

</head>
<body onkeydown="keyCode(event)">
	<?php
	include('sidebarHeader.php');
?>
<form action="" method="POST">
<div id="main" style="margin-left:200px">
	
<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
				<div class="modal-header">
	
					<p style="color:#000; font-weight:bold;font-size:17px;">Due Customer</p>
					<div class="row">
						<form method="POST">
							<div class="col-sm-2">
							</div>
							<div class="col-sm-7">
								<div class="input-group">
									<span class="input-group-addon"><b>Customer Name</b></span>
										<select class="form-control"  name="selCom" id="selCom" tabindex="1">
											<option value="">-- Customer Name --</option>
												<?php
													$selcom=mysql_query("select * from generate_invoice");
													while($row=mysql_fetch_array($selcom))
													{
														$selSum=mysql_query("select sum(amount),sum(debit) from statement where invoice_id='$row[0]'");
													while($rowSum=mysql_fetch_array($selSum))
													{
														$totalAmt=$rowSum[0]-$rowSum[1];
														if($totalAmt>0)
														{
															?>
														<option value="<?php echo $row[0]; ?>"><?php echo $row['cname']." : ".$row['address1']; ?></option>
															<?php
														}
													}
												
													}
												?>
											</select> 
									<span class="input-group-btn"><button type="submit" name="btnSearch" id="btnSearch" class="btn btn-danger" tabindex="4" /><span class="glyphicon glyphicon-search"></span></button></span>
								</div>
							</div>
				
							<div class="col-sm-2">
								
							</div>
						</form>
					</div>
					
				</div>
				<div class="modal-body" style="padding:10px 10px;">
					<div class="row">
							<div class="col-sm-12">
								<?php
									if(isset($_POST['btnSearch']))
									{	
									$result1=mysql_query("select sum(credit),sum(debit),sum(amount) from statement where invoice_id='".$_POST['selCom']."'");				
									while($row1=mysql_fetch_array($result1))
									{
									?>
										<center>
											<div class="w3-center w3-panel w3-topbar w3-bottombar w3-border-green w3-pale-red" style="margin-top:5px;">
												Statement<br>
												<b class="w3-opacity">Due Amt: <?php echo $totalAmount=$row1[2]-$row1[1]; ?> /-</b>
												</div>
											
										</center>
									<?php
									}
								?>		
						
							<?php
								if($totalAmount>0)
								{
							?>
								<div class="w3-responsive">
									<div class="col-sm-12">
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
												$resStatement1=mysql_query("select ge.invoice_id,ge.cname,ge.ccontact,ge.address1,st.st_date,st.amount,st.credit,st.debit,st.remark,st.status,st.st_id from generate_invoice ge,statement st where ge.invoice_id=st.invoice_id and st.invoice_id='".$_POST['selCom']."'");				
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
													<td><center><a href="?deleteID=<?php echo $rowStP[10]; ?>" onClick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"></i> </a></center></td>
														
													
													</tr>
												<?php
													
													
												}
											?>
											<tr>
												<td><a href="cashReceive.php?invoiceId=<?php echo $_POST['selCom']; ?>" class="btn btn-success" tabindex="3">CASH PAY</a></td>
											</tr>
										</table>
									</div>
									</div>
							
								
								<?php
							}
							}
							?>
						</div>
				</div>
			</div>
			</div>
</div>
</div>
<?php
	if(isset($_REQUEST['deleteID']))
	{
		mysql_query("delete from statement where st_id='".$_REQUEST['deleteID']."'");
		echo "<script>window.location='creditReport.php'</script>";
	}
?>

</form>	
</body>
</html>