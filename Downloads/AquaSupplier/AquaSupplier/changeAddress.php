
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
	
         <p style="color:#000; font-weight:bold;font-size:17px;">Change Address</p>
			<form role="form" method="POST">
			<div class="row">
			
			<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Truck No</b></span>
					 <select id="selArea" name="selArea" class="form-control" tabindex="1">
							<?php
								  mysql_query("set names utf8");
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
					
              <button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="6"><span class="glyphicon glyphicon-edit"></span> Change Now</button>
           
				</div>
			</div>
			
					 <?php
						if(isset($_POST['btnSave']))
						{
							
							echo "<script>window.location='swapAddress.php?truckID=$_POST[selArea]'</script>";		
							//header('location:swapAddress.php?truckID='.$_POST['selArea']);
						}
					  ?>
			
        
          </form>
        </div>
 </div>
 
</div>
</div>
	
<script>
$(document).ready(function(){
	$('#productData').DataTable();
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
</form>	
</body>
</html>