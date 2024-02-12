
<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

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
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">	
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
<script type="text/javascript">
		$(document).ready(function(){
			
			$("#selArea").change(function(){
				var id=$(this).val();
				var datastring='id='+id;				
				$.ajax({
					type:"POST",
					url: "getAreaCustomer.php",
					data:datastring,
					cache: false,
					success: function(html)
					{
						$("#selCustomer").html(html);
					}
				});
			});
			
			
		});
	</script>
<script type="text/javascript">
					$(document).ready(function()
					{   
						$("#txtMonth").datepicker({
							dateFormat: 'mm-yy',
							changeMonth: true,
							changeYear: true,
							showButtonPanel: true,

							onClose: function(dateText, inst) {
								var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
								var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
								$(this).val($.datepicker.formatDate('mm-yy', new Date(year, month, 1)));
							}
						});
						
						$("#txtMonth").focus(function () {
							$(".ui-datepicker-calendar").hide();
							$("#ui-datepicker-div").position({
								my: "center top",
								at: "center bottom",
								of: $(this)
							});
						});
					});
					</script>	

</head>
<body style="background:#e6e6e6;color:black;">
<?php
	include('sidebarHeader.php');
?>
<form  method="POST">
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
		<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
         <p style="color:#000; font-weight:bold;font-size:15px;">Customer Report</p>
			<div class="row">
			
			<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Truck No</b></span>
					 <select id="selArea" name="selArea" class="form-control input-sm" required >
						<option value="">----Select Truck No----</option>
							<?php
								
								$fetchArea=mysql_query("SELECT * FROM truck_master");
								while($rowFetchArea=mysql_fetch_array($fetchArea))
								{
									?>
										<option value="<?php echo $rowFetchArea[0];?>"><?php echo $rowFetchArea[1];?></option>
									<?php
								}
							?>							
					 </select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="input-group">
					  <span class="input-group-addon"><b>Customer</b></span>
					 <select id="selCustomer" name="selCustomer" class="form-control input-sm" required >
												<option value="">----Select Customer-----</option>
					 </select>
					</div>
				</div>
				
				<div class="col-sm-2">
				<div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon input-sm"><b>Month</b></span>
						<input type="text" name="txtMonth" id="txtMonth" class="form-control input-sm" placeholder="Month" required >						
						</div>	
					</div>
				</div>
				<div class="col-sm-1">
				<div class="form-group">
						<input type="submit" name="btnViewBill" id="btnViewBill" style="font-weight:bold;" value="View Bill" class="btn btn-info input-sm" >						
						
					</div>
				</div>
				<div class="col-sm-1">
				<div class="form-group">
						<input type="submit" name="btnYearReport" id="btnYearReport" style="font-weight:bold;" value="Yearly Report" class="btn btn-warning input-sm" >												
					</div>
				</div>
			</div>
		
        </div>
		<div class="modal-body" style="padding:5px 5px;">
			<div class="row">
				<div class="col-sm-12">
				<?php
					if(isset($_POST['btnViewBill']))
					{	
					$test=$_POST['selCustomer'];
								echo "<script>window.location='printBOSRo.php?custID=$_POST[selCustomer]&monthYear=01-$_POST[txtMonth]'</script>";		
						//header('location:printBOSRo.php?custID='.$_POST['selCustomer'].'&monthYear=1-'.$_POST['txtMonth']);
					}
					
					if(isset($_POST['btnYearReport']))
					{
						$year=date('Y',strtotime('01-'.$_POST['txtMonth']));
						mysql_query("set names utf8");
						$resClient=mysql_query("select * from customer_master where customer_id='".$_POST['selCustomer']."'");
					while($rowClient=mysql_fetch_array($resClient))
					{
						$clientName=$rowClient['customer_name'];
						$clientAddress=$rowClient['customer_address'];
						 $clientContact=$rowClient['customer_contact'];
					}
						?>
						<b style="float:right;font-size:17px;"><?php echo $year; ?></b>
						<center><b style="float:center;font-size:17px;"><?php echo $clientName; ?></b><br>
						<b style="margin-right:40px;"><?php echo "Address :".$clientAddress; ?></b>
						<b style="margin-left:20px;"><?php echo "Contact :".$clientContact; ?></b>
						</center>
						<table class="table">
				<tr style="background-color:#808080;color:#ffffff;font-weight:bold;">
					<th>Month</th>
					<th>Supply Qty</th>
					
					<th>Return Qty</th>
					<th>Deposite Amount</th>
					<th>Amount</th>
					<th>Due Total</th>
					<th><center>View Bill</center></th>
				</tr>
				<?php
					$sumReturnQty=0;
					$sumSupplyQty=0;
					$sumPlanRate=0;
					$sumDepositeAmt=0;
					for($i=1;$i<13;$i++)
					{
						$startDate=$year.'-'.$i.'-'.'1';
						$endDate=$year.'-'.$i.'-'.'31';
						
						$resSum=mysql_query("select sum(supplied_qty),sum(return_qty),sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='".$_POST['selCustomer']."' and supply_date between '$startDate' and '$endDate'");
						while($rowSum=mysql_fetch_array($resSum))
						{
							$totalSpQty=$rowSum[0];
							$totalRQty=$rowSum[1];
							$totalPlanRate=$rowSum[2];
							$totalDepositeAmount=$rowSum[3];
							$sumReturnQty=$sumReturnQty+$totalRQty;
							$sumSupplyQty=$sumSupplyQty+$totalSpQty;
							$sumPlanRate=$sumPlanRate+$totalPlanRate;
							$sumDepositeAmt=$sumDepositeAmt+$totalDepositeAmount;
							?>
						<tr>
							<td><?php echo date('M-Y',strtotime('1-'.$i.'-'.$year)); ?></td>
							<td><?php if($totalSpQty>0){echo $totalSpQty; }else{ echo "-";}?></td>
							
							<td><?php if($totalRQty>0){echo $totalRQty;}else{ echo "-"; } ?></td>
							
							<td><?php if($totalDepositeAmount>0){ echo $totalDepositeAmount;}else{ echo "-";} ?></td>
							<td><?php if($totalPlanRate>0){echo $totalPlanRate;}else{echo "-";} ?></td>	
							<td><?php echo $totalPlanRate-$totalDepositeAmount; ?></td>	
							<td><center><a href="printBOS.php?custID=<?php echo $_POST['selCustomer'].'&monthYear='.$i.'-'.$year; ?>" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-eye-open"></i> </a></center></td>	
						</tr>
						<?php
						}
					
						
					}
					?>
						<tr style="background-color:#808080;color:#ffffff;font-weight:bold;">
							<td>Total</td>
							<td><?php if($sumSupplyQty>0){echo $sumSupplyQty; }else{ echo "-";}?></td>
							
							<td><?php if($sumReturnQty>0){echo $sumReturnQty;}else{ echo "-"; } ?></td>
							
							<td><?php if($sumPlanRate>0){ echo $sumPlanRate;}else{ echo "-";} ?></td>
							<td><?php if($sumDepositeAmt>0){echo $sumDepositeAmt;}else{echo "-";} ?></td>	
							<td><?php echo $sumPlanRate-$sumDepositeAmt; ?></td>	
							<td></td>	
						</tr>
					
			</table>
						<?php
					}
				?>
				</div>
			
			</div>
		</div>
 </div>
 
</div>
</div>

</form>	
</body>
</html>