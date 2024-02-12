
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
	
         <p style="color:#000; font-weight:bold;font-size:17px;">Add New Plans</p>
			<form role="form" method="POST">
			<div class="row">
				<div class="col-sm-5">
					<div class="input-group">
					  <span class="input-group-addon"><b>Plan Name</b></span>
					  <input type="text" class="form-control" name="txtPlan" id="txtPlan" placeholder="Plan Name" required tabindex="1" />
					</div>
				</div>
				<!--<div class="col-sm-5">
					<div class="input-group">
					  <span class="input-group-addon"><b>Plan Rate</b></span>
					  <input type="text" class="form-control" name="txtRate" id="txtRate" placeholder="Plan Rate" required tabindex="2" />
					</div>
				</div>-->
				
				<div class="col-sm-2">
					<button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="3"><span class="glyphicon glyphicon-plus"></span> Add New Plan</button>
				</div>
				
			</div>
			<div class="row">
				 <?php
						if(isset($_POST['btnSave']))
						{  mysql_query("set names utf8");
							$i=mysql_query("insert into plan_master (plan_name,plan_rate) values ('".strtoupper($_POST['txtPlan'])."','".$_POST['txtRate']."')");
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
										echo "<strong>Error !!</strong>";
										echo"</div>";		
							}
						}
					  ?>
			</div>
        
          </form>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
			<div class="row">
		
		
				<div class="col-sm-12">
					

			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
				<thead>
				<tr class="danger">
					<th>Plan Name</th>
					
					<th><center>Action</center></th>
				</tr>
				</thead>
				<?php
				  mysql_query("set names utf8");
					$result=mysql_query("select * from plan_master");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							
							<td><center><a href="editPlan.php?pid=<?php echo $row[0]; ?>" style="color:#1B5E20;" > Edit </a> </center></td>	
						</tr>
						<?php
					}
				?>	
			</table>
				</div>
			<?php
				if(isset($_REQUEST['id']))
				{
					mysql_query("delete from area_master where area_id='".$_REQUEST['id']."'");
					echo "<script>window.location='AddArea.php'</script>";		
					//header('location:AddArea.php');
				}
			?>	
			</div>
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