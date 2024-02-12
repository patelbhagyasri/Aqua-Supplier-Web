
<?php
include_once('Android/connection.php');

if (!isset($_SESSION['name'])) {
	echo "<script>window.location='index.php'</script>";		
	//header('location:index.php');
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
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link href="bootstrap/css/font.css" rel="stylesheet"> 
<link href="bootstrap/css/custstyle.css" rel="stylesheet"> 
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
 <script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script>
<script src="bootstrap/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>

<script src="bootstrap/DataTables/js/datatables.bootstrap.min.js" type="text/javascript"></script>
<link href="bootstrap/DataTables/css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />

<script src="bootstrap/swal/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="bootstrap/swal/sweetalert2.common.js" type="text/javascript"></script>

<link href="bootstrap/swal/sweetalert2.css" rel="stylesheet" type="text/css" />	

<script src="bootstrap/swal/sweetalert2.js" type="text/javascript"></script>

<link href="bootstrap/swal/sweetalert2.min.css" rel="stylesheet" type="text/css" />	

<script src="bootstrap/swal/sweetalert2.min.js" type="text/javascript"></script>
	<style>
		.mar{
		margin-top:20px;
		}
	</style>
	<script>
 $(document).ready(function()
	{
		$('#txtArea').focus();

		$( "#txtArea").keypress(function( event ) {
		if ( event.which == 13) {
			 $('#btnSave').focus();
			return false;
		  }
		});
		
		
		
		$( "#btnSave").keypress(function( event ) {
		if ( event.which == 13) {
			
			if($('#txtArea')=="")
			{
			$('#txtArea').focus();
			return false;
			}
		  }
		});
		
	});
</script>

	<script type="text/javascript">
$(document).ready(function(){

        $("#msg").fadeIn("slow", function(){
            // Code to be executed
            
        });
		
		  $("#msg").fadeOut(3000, function(){
            // Code to be executed
            
  
    });
   
});
</script>
<script>
shortcut("F5",function() {
	window.location("Purchase.php");
});
</script>

</head>
<body style="color:black; font-family:Arial;" onkeydown="keyCode(event)">
<?php
	include('menu.php');
?>
<form action="" method="POST">

	<!-- Main Body Starts -->
<div class="container-fluid" style="margin-top:10px;">


 <div class="modal-content">
        <div class="modal-header">
	
         <p style="color:#000; font-weight:bold;font-size:17px;">Add Orders</p>
			<form role="form" method="POST">
			<div class="row">
				<div class="col-sm-3">
					
				</div>
				<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Area Name</b></span>
					  <input type="text" class="form-control" name="txtArea" id="txtArea" placeholder="Enter Customer Name" required tabindex="1" />
					</div>
				</div>
				
				<div class="col-sm-3">
					<button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="2"><span class="glyphicon glyphicon-plus"></span> Add New Area</button>
				</div>
				<div class="col-sm-3">
					
               <?php
						if(isset($_POST['btnSave']))
						{  mysql_query("set names utf8");
							$i=mysql_query("insert into area_master (area_name) values ('".strtoupper($_POST['txtArea'])."')");
							if($i>0)
							{
										?>
										<script>
											swal({
												 title: "Area Added!",
												 
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
			
        
          </form>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
			<div class="row">
		
		
				<div class="col-sm-12">
					

			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
				<thead>
				<tr class="danger">
					<th>Area Name</th>
					
					<th><center>Action</center></th>
				</tr>
				</thead>
				<?php
				  mysql_query("set names utf8");
					$result=mysql_query("select * from area_master");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							
							<td><center><a href="EditCustomer.php?id=<?php echo $row[0]; ?>" style="color:#1B5E20;" > Edit </a> | <a href="?id=<?php echo $row[0]; ?>" onClick="return confirm('Are You Sure?')" style="color:#E91E63;" > Delete </a> | <a href="CustomerOB.php?id=<?php echo $row[0]; ?>" style="color:blue;"> OBalance </a></center></td>	
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
					//header('location:AddArea.php');
					echo "<script>window.location='AddArea.php'</script>";		
				}
			?>	
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