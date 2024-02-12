<?php
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

<!-- css -->
 <link rel="stylesheet" href="bootstrap/css/w3.css">
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">	
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
<form action="" method="POST">
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
		<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
		<?php 
			mysql_query("set names utf8");
			$resDriver=mysql_query("select * from truck_master where truck_id='".$_REQUEST['truckID']."'");
			while($rowDriver=mysql_fetch_array($resDriver))
			{
				
				$truckNo=$rowDriver['truck_number'];
				$password=$rowDriver['password'];
				//$password=$rowDriver['driver_address'];
			}
		?>
		
         <h4 style="color:#000; font-weight:bold;font-size:17px;"> Edit Truck</h4>
		 
		 <form role="form" method="POST">
			
			<div class="row">
				
				<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Truck No</b></span>
					  
					  <input type="text" class="form-control input-sm" placeholder="Truck No" value="<?php echo $truckNo; ?>" name="txtUser" id="txtUser"  tabindex="4" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Password</b></span>
					  
					  <input type="text" class="form-control input-sm" placeholder="Password" name="txtPass" value="<?php echo $password; ?>" id="txtPass"  tabindex="5" />
					</div>
				</div>
				
					<!--<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>City</b></span>
           
					  <input type="text" class="form-control input-sm" name="txtCity" id="txtCity" placeholder="City Name"  tabindex="6" />
					</div>
					</div>-->
					<div class="col-sm-3">
					<div class="form-group">
            
              <button type="submit" class="btn btn-primary pull-left" name="btnSave" id="btnSave" tabindex="7"><span class="glyphicon glyphicon-pencil"></span><b> Update Truck</b></button>
            </div>
				</div>
				
				
				</div>	
				<div class="row">
					 <?php
						if(isset($_POST['btnSave']))
						{
							mysql_query("set names utf8");
							//$i=mysql_query("insert into truck_master (driver_name,driver_contact,driver_address,truck_number,password) values ('".strtoupper($_POST['txtName'])."','".$_POST['txtContact']."','".strtoupper($_POST['txtAddress'])."','".$_POST['txtUser']."','".$_POST['txtPass']."')");
							$i=mysql_query("update truck_master set truck_number='".$_POST['txtUser']."',password='".$_POST['txtPass']."' where truck_id='".$_REQUEST['truckID']."'");
							if($i>0)
									{
										echo "<script>window.location='AddDriver.php'</script>";
										
									}
									else
									{
										echo "<div class='alert alert-danger'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>ERROR !!</strong>";
										echo"</div>";
									}
						}
					  ?>
				</div>
			
        
          </form>
		
        </div>
		<div class="modal-body" style="padding:5px 5px;">
			
				</div>
		
		</div>
	
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