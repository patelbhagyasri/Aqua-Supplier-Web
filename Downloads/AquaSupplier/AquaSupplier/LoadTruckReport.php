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
<title>Load Truck Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
			
			<div class="col-sm-3">
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
				<div class="col-sm-2">
				<div class="form-group">
					  <b>Start Date</b>
					<input type="text" name="txtStartDate" id="txtStartDate" class="form-control input-sm" placeholder="Start Date" autocomplete="off" required tabindex="2"/>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="input-group">
					  <b>End Date</b>
					<input type="text" name="txtEndDate" id="txtEndDate" class="form-control input-sm" placeholder="End Date" required tabindex="3"/>
			</div>
			</div>
			<div class="col-sm-2">
						 <div class="form-group">
						 <br>
						  <button type="submit" class="btn btn-info" name="btnProduct" id="btnProduct" tabindex="4"><span class="glyphicon glyphicon-search"></span> Search</button>
						   
						</div> 
						
			
				
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
			<th>Date</th>
			
			<th><center>Action</center></th>
		</tr>
		</thead>
		<?php
			if(isset($_POST['btnProduct']))
				{
					$startDate=date('Y-m-d',strtotime($_POST['txtStartDate']));
					$endDate=date('Y-m-d',strtotime($_POST['txtEndDate']));
					mysql_query("set names utf8");
					$result=mysql_query("select * from load_truck where load_date between '$startDate' and '$endDate' and truck_id='".$_POST['selTruck']."'");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $row[3]; ?></td>
							<td><?php echo date('d-M-Y',strtotime($row[4])); ?></td>
							<td><center><a id="delete_product" onClick="return confirm('Are you Sure?')" href="?deleteID=<?php echo $row[0]; ?>" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"></i> </a></center></td>	
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
<?php
	if(isset($_REQUEST['deleteID']))
	{
		mysql_query("delete from load_truck where lt_id='".$_REQUEST['deleteID']."'");
		echo "<script>window.location='LoadTruckReport.php'</script>";
	}
?>
	
</form>	
</body>
</html>