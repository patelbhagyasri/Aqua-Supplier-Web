<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
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
<title>Add Employee Attendance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- css -->
<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
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


	<script>
				$(function () {
					$("#checkAll").click(function () {
						if ($("#checkAll").is(':checked')) {
							$(".chkEmp").prop("checked", true);
						} 
						else {
							$(".chkEmp").prop("checked", false);
						}
						
					});
					$(".chkEmp").click(function () {
						if ($(".chkEmp").is(':unchecked')) {
							$("#checkAll").prop("unchecked", true);
							} 
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
		<?php
			//include('menu.php');
		?>
         <p style="color:#000; font-weight:bold;font-size:15px;">ATTENDANCE</p>
		
		 <div class="row">			
			<div class="col-sm-3">
				<div class="input-group">
					  <span class="input-group-addon"><b>Shift Type</b></span>
					  <select class="form-control" id="selShip" name="selShip" tabindex="1" required>
							<option value="PD">Day Shift</option>
							<option value="PN">Night Shift</option>
						
						</select> 
				</div>
			</div>
			<div class="col-sm-3">
					<div class="input-group">
					  <span class="input-group-addon"><b>Salary</b></span>
						<input type="text" class="form-control input-sm" name="txtSalary" id="txtSalary" placeholder="Salary Amount" tabindex="2" />
           
				</div>
			</div>
			<div class="col-sm-2">
					<div class="input-group">
					  
					  <span class="input-group-addon"><b>Date</b></span>
					  <input type="text" class="form-control input-sm" placeholder="Date" name="txtDate" id="txtDate" required  tabindex="3" />
					
				</div>
			</div>
			<div class="col-sm-2">
						
						<button type="submit" class="btn btn-success btn-block" name="btnSubmit" id="btnSubmit" tabindex="4"><span class="glyphicon glyphicon-plus"></span> Add Attendance</button>
			</div>  
			<div class="col-sm-1">
				<a href="todayAttendance.php" class="btn btn-info" tabindex="5">Today Attendance</a>
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
			<th>Address</th>
			<th>Daily Salary Amount</th>
			
			
			<th><center>All <input type="checkbox" name="checkAll" id="checkAll"></center></th>
		</tr>
		</thead>
		<?php
			mysql_query("set names utf8");
			$result=mysql_query("select * from tbl_employee ORDER BY empID DESC");
			while($row=mysql_fetch_array($result))
			{
				?>
				<tr>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><center><input type="checkbox" name="chkattendance[]" id="chkattendance" value="<?php echo $row[0]?>" class="chkEmp"></center></td>	
				</tr>
				<?php
			}
		?>	
			</table>
		</div>
		</div>
			<div class="row">
				<?php
				if(isset($_POST['btnSubmit']))
				{
					$attendance=$_POST['chkattendance'];
					$attDate=date('Y-m-d',strtotime($_POST['txtDate']));
						foreach($attendance as $chknew)
						{
							//$ch .= $chknew.",";
								mysql_query("set names utf8");
							$resAtt=mysql_query("select * from tbl_employee where empID='$chknew'");
							while($rowAtt=mysql_fetch_array($resAtt))
							{
								if($_POST['txtSalary']=="")
								{
									$salAmt=$rowAtt[4];
								}
								else
								{
									$salAmt=$_POST['txtSalary'];
								}
								mysql_query("INSERT INTO  emp_attendance(empID,status,at_date,salaryAmount) VALUES ('$rowAtt[0]','".$_POST['selShip']."','$attDate','$salAmt')");
								
							}
							
						}
										echo "<div class='alert alert-success'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>Record Saved !!</strong>";
										echo"</div>";
					
				}
			  ?>
			</div>
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