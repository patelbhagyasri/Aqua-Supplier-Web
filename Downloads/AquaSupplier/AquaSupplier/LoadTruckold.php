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

	 <link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

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
		
		
         <p style="color:#000; font-weight:bold;font-size:17px;">Load Truck</p>
		 <div class="row">
			
			<div class="col-sm-2">
					<div class="form-group">
					 <b>Truck No</b>
					 <select id="selTruck" name="selTruck" tabindex="1" class="form-control input-sm" required >
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
				<div class="col-sm-3">
					<div class="form-group">
					 <b>Employee Name</b>
					 <select id="selEmp" name="selEmp" tabindex="2" class="form-control input-sm" required >
						<option value="">----Select Employee----</option>
							<?php
									mysql_query("set names utf8");
								$fetchEmp=mysql_query("SELECT * FROM tbl_employee where designation='Driver'");
								while($rowEmp=mysql_fetch_array($fetchEmp))
								{
									?>
										<option value="<?php echo $rowEmp[0];?>"><?php echo $rowEmp[1];?></option>
									<?php
								}
							?>							
					 </select>
					</div>
				</div>
				
			<div class="col-sm-1">
				<div class="form-group">
					  <b>Qty</b>
					<input type="text" name="txt_product_qty" id="txt_product_qty" class="form-control input-sm" placeholder="Qty" required tabindex="4"/>
			</div>
			</div>
			
			<div class="col-sm-2">
						 <div class="from-group">
							<br>
						 <button type="submit" class="btn btn-primary" name="btnProduct" id="btnProduct" tabindex="5"><span class="glyphicon glyphicon-plus"></span> Load Truck</button>
						   
						</div> 
						
			
				
			</div>
			
			<div class="col-sm-2">
			 <?php
				if(isset($_POST['btnProduct']))
				{
					mysql_query("set names utf8");
					$resEmp=mysql_query("select * from tbl_employee where empID='".$_POST['selEmp']."'");
						while($rowEmp=mysql_fetch_array($resEmp))
						{
							$driverName=$rowEmp['empName'];
						}
					$loadDate=date('Y-m-d');
					mysql_query("set names utf8");
					$i=mysql_query("INSERT INTO load_truck(truck_id,driver_name,product_qty,load_date,empID) VALUES ('".$_POST['selTruck']."','$driverName','".$_POST['txt_product_qty']."','$loadDate','".$_POST['selEmp']."')");
					if($i>0)
					{
						?>
										<script>
											swal({
												 title: "Load Truck Added!",
												 
												 type: "success",
												 timer: 1000
												 },
												 function () {
														location.reload(true);
														tr.hide();
												 });
										</script>
										<?php
					}
					else
					{
						?>
										<script>
											swal({
												 title: "Error!",
												 text:"Something goes wrong",
												 type: "error",
												 timer: 1000
												 },
												 function () {
														location.reload(true);
														tr.hide();
												 });
										</script>
										<?php
					}
				}
			  ?>	
			</div>
			
			
			
		</div>
		
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		<div class="row">
	
		
		<div class="col-sm-12">
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
		<thead>
		<tr class="danger">
		
			<th>Driver Name</th>
			<th>Qty</th>
			
			<th><center>Action</center></th>
		</tr>
		</thead>
		<?php
		mysql_query("set names utf8");
			$result=mysql_query("select * from load_truck where load_date=CURDATE()");
			while($row=mysql_fetch_array($result))
			{
				?>
				<tr>
				
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><center><a href="?deleteID=<?php echo $row[0]; ?>" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"></i> </a></center></td>	
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
	if(isset($_REQUEST['deleteID']))
	{
		mysql_query("delete from load_truck where lt_id='".$_REQUEST['deleteID']."'");
		echo "<script>window.location='LoadTruck.php'</script>";
	}
?>
</div>
</div>
	<!-- Main Body Starts -->
	
<script>
$(document).ready(function(){
	$('#productData').DataTable();
});
</script>
</form>	
</body>
</html>