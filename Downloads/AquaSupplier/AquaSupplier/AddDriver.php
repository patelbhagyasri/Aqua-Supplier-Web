<?php
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
<style>
.list-group-item {
    position: relative;
    display: block;
    padding: 5px 10px !important;
    margin-bottom: -1px;
   
    border: 1px solid #ddd;
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
		
		
         <h4 style="color:#000; font-weight:bold;font-size:17px;"> Add Truck</h4>
		 
		 <form role="form" method="POST">
			
			<div class="row">
				
				<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Truck No</b></span>
					  
					  <input type="text" class="form-control input-sm" placeholder="Truck No" name="txtUser" id="txtUser" required  tabindex="4" />
					</div>
				</div>
				<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Password</b></span>
					  
					  <input type="text" class="form-control input-sm" placeholder="Password" name="txtPass" id="txtPass" required tabindex="5" />
					</div>
				</div>
				
				<div class="col-sm-3">
				<div class="form-group">
            
              <button type="submit" class="btn btn-primary pull-left" name="btnSave" id="btnSave" tabindex="7"><span class="glyphicon glyphicon-pencil"></span><b> Add Truck</b></button>
            </div>
				</div>
				
				
				</div>	
				<div class="row">
					 <?php
						if(isset($_POST['btnSave']))
						{
							mysql_query("set names utf8");
							$i=mysql_query("insert into truck_master (truck_number,password) values ('".$_POST['txtUser']."','".$_POST['txtPass']."')");
							if($i>0)
									{
										echo "<div class='alert alert-success'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>Record Saved !!</strong>";
										echo"</div>";
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
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
		<thead>
				<tr class="danger">
					
					<th>Truck No</th>
					<th>Password</th>
					<th><center>Action</center></th>
				</tr>
				</thead>
				<?php
					mysql_query("set names utf8");
					$result=mysql_query("select * from truck_master");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><center><a class="btn btn-sm btn-success" title="Edit" href="EditDriver.php?truckID=<?php echo $row[0]; ?>" > <i class="glyphicon glyphicon-edit"></i> </a> </center></td>	
						</tr>
						<?php
					}
				?>	
			</table>
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