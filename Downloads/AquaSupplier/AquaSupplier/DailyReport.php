<?php
include_once('connection.php');
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');
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

<!-- css -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="color:black; font-family:Arial;">
<form action="" method="POST">
<div class="container" style="margin-top:10px;">
<div class="row">
		<div class="modal-body">
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
			
		</div>
			<div id="divGetCustomer">
			
			</div>
		</div>
		
</div>
</div>
		

</form>	
</body>
</html>
<script>
$(document).ready(function(){

 $("#selTruck").change(function()
		{
		
			//var id=$("#selTruck").val();
			var dataString = {truckid: $("#selTruck").val()};			
			$.ajax
			({
				type: "POST",
				url: "getDataTruckWise.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
					$("#divGetCustomer").html(html);
					
				} 
			});
		});
		
		$("#txtMonth").blur(function()
		{
			$('#selTruck').prop('selectedIndex',0);
		});
});
</script>

