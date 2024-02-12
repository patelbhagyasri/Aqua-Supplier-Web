
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
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/w3.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">	
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
		
         <p style="color:#000; font-weight:bold;font-size:15px;">ADD Employee Advance</p>
			<form role="form" method="POST">
			<div class="row">
				<div class="col-sm-4">
				<div class="input-group">
					 <b> Employee</b>
					  <select class="form-control" id="selFarmer" name="selFarmer" tabindex="1" autofocus required>
							<option value="">-- Select Employee Name --</option>
						<?php
							$selcom=mysql_query("select * from tbl_employee where status='active'");
							while($row=mysql_fetch_array($selcom))
							{
						?>
							<option value="<?php echo $row['empID']; ?>"><?php echo $row['empName']; ?></option>
						<?php
							}
						?>
						</select> 
					</div>
				</div>
				<div class="col-sm-2">
					<div class="input-group">
					 <b>Date</b>
					  <input type="text" class="form-control" placeholder="Date" name="txtDate" id="txtDate" required  tabindex="2" />
					</div>
				</div>
				
				<div class="col-sm-2">
					<div class="input-group">
					  <b>Amount</b>
						<input type="text" class="form-control" name="txtAmount" id="txtAmount" placeholder="Amount" tabindex="4" />
           
				</div>
				</div>
				<div class="col-sm-2">
				<br>
              <button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="8"><span class="glyphicon glyphicon-plus"></span> Add Statement</button>
           
				</div>
			</div>
			
			<div class="row">
				<?php
						if(isset($_POST['btnSave']))
						{		
							
							$i=mysql_query("insert into emp_upad(empID,upad_date,upadAmount) 
							values ('".$_POST['selFarmer']."','".date('Y-m-d',strtotime($_POST['txtDate']))."','".$_POST['txtAmount']."')");
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
										echo "<strong>Not Added !!</strong>";
										echo"</div>";
							}
						}
					  ?>
				
			</div>
        <br>
          </form>
		<div class="row">
			<div class="col-sm-6">
			</div>
			
			<div class="col-sm-6">
				<?php
					$resultsum=mysql_query("select sum(upadAmount) from emp_upad where upad_date=CURDATE()");
					while($rowSum=mysql_fetch_array($resultsum))
					{
						
						 $upad=$rowSum[0];
						
					}
				?>
						<div class="row">
							<div class="col-sm-6">
							
							</div>
							
							<div class="col-sm-6 well well-sm">
							Today Upad : <?php echo $upad;?>
							</div>
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
					<th>Employee Name</th>
					
					<th>Amount</th>
					<th>Upad Date</th>
					<th><center>Action</center></th>
				</tr>
				</thead>
				<?php
					$result=mysql_query("select eu.emp_up_id,emp.empName,eu.upadAmount,eu.upad_date from emp_upad eu,tbl_employee emp where emp.empID=eu.empID");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>							
							<td><?php echo date('d-M-Y',strtotime($row[3])); ?></td>
							
							<td><center><a href="?id=<?php echo $row[0]; ?>" onClick="return confirm('Are You Sure?')" style="color:#E91E63;" > Delete </a></td>	
						</tr>
						<?php
					}
				?>	
			</table>
				</div>
			<?php
				if(isset($_REQUEST['id']))
				{
					mysql_query("delete from emp_upad where emp_up_id='".$_REQUEST['id']."'");
					//header('location:employeeAdvance.php');
						echo "<script>window.location='employeeAdvance.php'</script>";	
				}
			?>	
			</div>
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
</form>	
</body>
</html>