<?php
include_once('connection.php');

if (!isset($_SESSION['name'])) {
	echo "<script>window.location='index.php'</script>";		
	//header('location:index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Water Supplied</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- css -->

<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />

<script src="bootstrap/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="bootstrap/DataTables/js/datatables.bootstrap.min.js" type="text/javascript"></script>
<link href="bootstrap/DataTables/css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />

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
		$("#btnSearch").click(function()
		{	
			var dataString = {truckID: $("#selTruck").val(),wsDate: $("#txtDate").val()}; 
		
			$.ajax
			({
				
				type: "POST",
				url: "fetchWaterSupplied.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
					
					$("#displayProduct").html(html);
					//$("#txtDate").focus();
					
				} 
			});
		});
		
	});
	
</script>
<script type="text/javascript">

	  
	   $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#txtDate" ).datepicker(
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
         <p style="color:#000; font-weight:bold;font-size:17px;">Display Product</p>		
		<br>
		<div class="row">
			<div class="col-sm-3">
					<div class="form-group">
					  <b>Truck No</b>
					 <select id="selTruck" name="selTruck" tabindex="1" autofocus class="form-control input-sm" required >
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
				<b>Date</b>
				<div class="input-group">
					
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>		
					<!--<input type="text" name="country" id="country" class="form-control input-sm" autocomplete="off" placeholder="Product Name" tabindex="4" required />-->
					<input type="text" name="txtDate" id="txtDate" class="form-control input-sm" autocomplete="off" placeholder="Date" tabindex="2" required />
					
				</div>
			</div>
			<div class="col-sm-2">
				<br>
				<div class="input-group">
					
					
					<a name="btnSearch" id="btnSearch" class="btn btn-success" tabindex="3" /> Search </a>
					
				</div>
			</div>
		</div>		
        </div>
			<div class="modal-body">
			<div id="displayProduct">
			
			</div>

        </div>
      </div>
	
</div>

	
<script>
$(document).ready(function(){
	$('#productData111').DataTable();
});
</script>
</form>	
</body>
</html>