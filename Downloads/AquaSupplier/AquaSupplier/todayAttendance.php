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
<title>Add Employee Attendance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="bootstrap/css/w3.css">
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
         <p style="color:#00E676; font-weight:bold;font-size:20px;">Today Attendance Report</p>
		
		 <div class="row">
			<div class="col-sm-10">
			</div>
			<div class="col-sm-2">
						
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
			<th>Shift</th>
			<th><center><input type="checkbox" name="checkAll" id="checkAll">
			<button type="submit" class="btn btn-info" name="btnDelete" id="btnDelete" tabindex="5"><span class="glyphicon glyphicon-minus"></span>Delete</button>
			
			</center>
			</th>
		</tr>
		</thead>
		<?php
			$totalAmt=0;
			$result=mysql_query("select et.attendanceID,et.salaryAmount,emp.empName,emp.address,et.status from emp_attendance et,tbl_employee emp where et.empID=emp.empID and et.at_date=CURDATE() ORDER BY emp.empID DESC");
			while($row=mysql_fetch_array($result))
			{
				?>
				<tr>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[1];
					$totalAmt=$row[1]+$totalAmt;
					?></td>
					<td><?php if($row['status']=="PN")
					{ 
					echo "Night Shift";
					}
					else
						{
						echo "Day Shift";
						}
						?></td>
					<td><center><input type="checkbox" name="chkattendance[]" id="chkattendance" value="<?php echo $row[0]?>" class="chkEmp"></center></td>	
				</tr>
				<?php
			}
		?>	
			
			</table>
			
			<b style="font-size:20px;"><?php echo "Total: ".$totalAmt; ?></b>
			
		</div>
		</div>
		
		<?php
	if(isset($_POST['btnDelete']))
	{
				$attendance=$_POST['chkattendance'];
				foreach($attendance as $chknew)
						{
							mysql_query("delete from emp_attendance where attendanceID='$chknew'");
						}
						
						//header('location:todayAttendance.php');
						echo "<script>window.location='todayAttendance.php'</script>";
	}
	?>
	
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