<?php

include_once('connection.php');
date_default_timezone_set("Asia/Calcutta");
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add New Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- css -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">	
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
<form  method="POST">
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
         <p style="color:#000; font-weight:bold;font-size:17px;">Load Truck Report</p>
		 <div class="row">
				<div class="col-sm-2">
				<div class="form-group">
					  <b>start Date</b>
					<input type="text" name="txtStartDate" id="txtStartDate" class="form-control input-sm" placeholder="Start Date" autocomplete="off" required tabindex="2"/>
				</div>
			</div>
			<div class="col-sm-2">
						 <div class="form-group">
						 <br>
						  <button type="submit" class="btn btn-info" name="btnProduct" id="btnProduct" tabindex="4"><span class="glyphicon glyphicon-search"></span> Load Truck</button>
						   
						</div> 
						
			
				
			</div>
			
		</div>
		
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		<div class="row">
	
		
		<div class="col-sm-12">
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
		<thead>
		
		</thead>
		<?php
			if(isset($_POST['btnProduct']))
				{
					$startDate=date('Y-m-d',strtotime($_POST['txtStartDate']));
				
					mysql_query("set names utf8");
					
					$resTruck=mysql_query("select lt.truck_id,tm.truck_number from load_truck lt,truck_master tm where lt.truck_id=tm.truck_id and lt.load_date='$startDate' GROUP BY lt.truck_id");
					
					$countRow=mysql_num_rows($resTruck);
					if($countRow>0)
					{
					while($rowTruck=mysql_fetch_array($resTruck))
					{
						?>
						<tr style="background-color:#808080;color:#fff;">
							<td>Truck No: <?php echo $rowTruck[1]; ?></td>
							<th >Cash Customer</th>
							
							<th></th>
							
						</tr>
					
						<?php
								mysql_query("set names utf8");
						$resLoadTruck=mysql_query("select * from load_truck lt where load_date='$startDate' and truck_id='$rowTruck[0]'");
						while($rowLoadTruck=mysql_fetch_array($resLoadTruck))
						{
							?>
						<tr style="">
							<td>Driver Name: <?php echo $rowLoadTruck[2]; ?></td>
							<th>
								<?php
										$totalDepositeSum=0;
										mysql_query("set names utf8");
										$resLTCustomer=mysql_query("select cm.customer_name,cm.house_no,sum(wsm.deposit_amount) from water_supply_master wsm,customer_master cm where cm.customer_id=wsm.customer_id and wsm.deposit_amount>0 and wsm.supply_date='$startDate' and wsm.lt_id='$rowLoadTruck[0]' GROUP BY cm.customer_name");
										while($rowLTCustomer=mysql_fetch_array($resLTCustomer))
										{
											$totalDepositeSum=$totalDepositeSum+$rowLTCustomer[2];
											$totalDeposite=$totalDeposite+$rowLTCustomer[2];
											?>
											<b style="float:right;">
											<?php echo $rowLTCustomer[0]." ".$rowLTCustomer[1]." :-".$rowLTCustomer[2];?></b><br>
											
											<?php
										}
									
								?>
							</th>
							
							<th><b style="">Total: <?php echo $totalDepositeSum; ?></b></th>
							
						</tr>
						
						<?php
						}
						
					}
					?>
						<tr style="background-color:#808080;color:#fff;font-weight:bold;">
							<td></td>
							<th ></th>
							
							<th>Total Amount: <?php echo $totalDeposite; ?></th>
							
						</tr>
					<?php
					
					}
					else
					{
						echo "<center>NO RECORD FOUND.....!!</center>";
					}
						mysql_query("set names utf8");
					$restotalExpense=mysql_query("select sum(amount) from expense_statement where ex_date='$startDate'");
					while($rowExpense=mysql_fetch_array($restotalExpense))
					{
						?>
						<tr style="background-color:#808080;color:#fff;font-weight:bold;">
							<td></td>
							<th ></th>
							
							<th>Total Expense: <?php echo $rowExpense[0]; ?></th>
							
						</tr>
					<?php
					}
						mysql_query("set names utf8");
					$resTotalUpad=mysql_query("select sum(upadAmount) from emp_upad where upad_date='$startDate'");
					while($rowUpad=mysql_fetch_array($resTotalUpad))
					{
						?>
						<tr style="background-color:#808080;color:#fff;font-weight:bold;">
							<td></td>
							<th ></th>
							
							<th>Total Upad: <?php echo $rowUpad[0]; ?></th>
							
						</tr>
					<?php
					}
			}
		?>	
			</table>
		</div>
		</div>
		</div>
      </div>

</div>
</div>

	
</form>	
</body>
</html>