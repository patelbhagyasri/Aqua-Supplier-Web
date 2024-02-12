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
<meta name="description" content="Star Enterprise" />
<meta name="author" content="Star Enterprise" />
<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
	<script type="text/javascript">
$(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#start_date" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
  
     $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#end_date" ).datepicker(
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
         <p style="color:#000; font-weight:bold;font-size:17px;">Employee Report</p>
			 <div class="row">
				  <form method="POST">
					<div class="col-sm-3">
						 <select class="form-control"  name="selCom" id="selCom" tabindex="1">
										<option value="all">-- Employee Name --</option>
									<?php
										mysql_query("set names utf8");
										$selcom=mysql_query("select * from tbl_employee");
										
									while($row=mysql_fetch_array($selcom))
										{
									?>
										<option value="<?php echo $row['empID']; ?>"><?php echo $row['empName']; ?></option>
									<?php
										}
									?>
						</select> 
					</div>
					<div class="col-sm-3">
						<input type="text" name="start_date" id="start_date"  class="form-control" placeholder="Start Date" tabindex="2" required />
					</div>
					
					<div class="col-sm-3">
					<input type="text" name="end_date" id="end_date" class="form-control" placeholder="End Date" tabindex="3" required />
					</div>
					<div class="col-sm-3">
						<input type="submit" name="btnSearch" id="btnSearch" class="btn btn-danger" value="Employee Statement" tabindex="4" />
					</div>
					</form>
				 </div>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		
					<div class="row">
		
		
				<div class="col-sm-7">
					<b style="font-size:15px;">Attendance</b>
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;">
				<thead>
				<tr class="danger">
					<th>Employee Name</th>
					<th>Address</th>
					<th>Daily Salary Amount</th>
					<th>Shift</th>
					<th>Date</th>
					<th><!--<center><input type="checkbox" name="checkAll" id="checkAll">
					<button type="submit" class="btn btn-info" name="btnDelete" id="btnDelete" tabindex="5"><span class="glyphicon glyphicon-minus"></span>Delete</button>
					
					</center>-->
					Action
					</th>
				</tr>
				</thead>
				<?php
					if(isset($_POST['btnSearch']))
					{
					$d1=strtotime($_POST['start_date']);
					$dd1=date('Y-m-d',$d1);
					$d2=strtotime($_POST['end_date']);
					$dd2=date('Y-m-d',$d2);
					if($_POST['selCom']=="all")
					{
					    	mysql_query("set names utf8");
						$result=mysql_query("select et.attendanceID,et.salaryAmount,emp.empName,emp.address,et.status,et.at_date from emp_attendance et,tbl_employee emp where et.empID=emp.empID and et.at_date BETWEEN '$dd1' AND '$dd2' ORDER BY et.at_date DESC");
					}
					else
					{
					    	mysql_query("set names utf8");
					$result=mysql_query("select et.attendanceID,et.salaryAmount,emp.empName,emp.address,et.status,et.at_date from emp_attendance et,tbl_employee emp where et.empID=emp.empID and et.at_date BETWEEN '$dd1' AND '$dd2' and et.empID='".$_POST['selCom']."' ORDER BY et.at_date DESC");
					}
					
					$count=1;
					while($row=mysql_fetch_array($result))
					{
						$date1=strtotime($row[5]);
						$datee1=date('d-M-Y',$date1);
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
									<td><?php echo $datee1; ?></td>
							<td><a href="?id=<?php echo $row[0]; ?>&inv_id=<?php echo $row[2]; ?>" onClick="return confirm('Are You Sure?')" > Delete </a></td>	
						</tr>
						<?php
					}
					
				}
				?>	
				
			</table>
			
				</div>
				
				<div class="col-sm-5">
					<b style="font-size:15px;">Upad</b>
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;">
				<thead>
				<tr class="danger">
					<th>Employee Name</th>
					<th>Upad Amount</th>					
					<th>Date</th>
					<th>Action</th>
				</tr>
				</thead>
				<?php
					if(isset($_POST['btnSearch']))
					{
				
					if($_POST['selCom']=="all")
					{
					    	mysql_query("set names utf8");
						$resultU=mysql_query("select eu.emp_up_id,emp.empName,eu.upadAmount,eu.upad_date from emp_upad eu,tbl_employee emp where emp.empID=eu.empID and eu.upad_date BETWEEN '$dd1' AND '$dd2'");						
					}
					else
					{
					    	mysql_query("set names utf8");
						$resultU=mysql_query("select eu.emp_up_id,emp.empName,eu.upadAmount,eu.upad_date from emp_upad eu,tbl_employee emp where emp.empID=eu.empID and eu.upad_date BETWEEN '$dd1' AND '$dd2' and eu.empID='".$_POST['selCom']."'");						
						//$result=mysql_query("select et.attendanceID,et.salaryAmount,emp.empName,emp.address,et.status,et.at_date from emp_attendance et,tbl_employee emp where et.empID=emp.empID and et.at_date BETWEEN '$dd1' AND '$dd2' and et.empID='".$_POST['selCom']."' ORDER BY et.at_date DESC");
					}
					
					$count=1;
					while($rowU=mysql_fetch_array($resultU))
					{
						$date1=strtotime($rowU[3]);
						$datee1=date('d-M-Y',$date1);
						?>
						<tr>
							<td><?php echo $rowU[1]; ?></td>
							<td><?php echo $rowU[2]; ?></td>
								
							<td><?php echo $datee1; ?></td>
							<td><a href="?id=<?php echo $rowU[0]; ?>" onClick="return confirm('Are You Sure?')" > Delete </a></td>	
						</tr>
						<?php
					}
					
					if($_POST['selCom']=="all")
					{
					    	mysql_query("set names utf8");
						$result1=mysql_query("select sum(salaryAmount) from emp_attendance where at_date BETWEEN '$dd1' AND '$dd2'");
					}
					else
					{
					    	mysql_query("set names utf8");
					$result1=mysql_query("select sum(salaryAmount) from emp_attendance where empID='".$_POST['selCom']."' and at_date BETWEEN '$dd1' AND '$dd2'");
					}
					while($row1=mysql_fetch_array($result1))
					{
						$amt=$row1[0];
					}
					if($_POST['selCom']=="all")
					{
					    	mysql_query("set names utf8");
						$result1U=mysql_query("select sum(upadAmount) from emp_upad where upad_date BETWEEN '$dd1' AND '$dd2'");
					}
					else
					{
					    	mysql_query("set names utf8");
					$result1U=mysql_query("select sum(upadAmount) from emp_upad where empID='".$_POST['selCom']."' and upad_date BETWEEN '$dd1' AND '$dd2'");
					}
					while($row1U=mysql_fetch_array($result1U))
					{
						$upadAmt=$row1U[0];
					}
				}
				?>	
				
			</table>			
				</div>
				<div class="container-fluid">
				<div class="btn-group btn-group-justified">
							<div class="btn-group">
							 <label class="btn btn-primary">Total : <?php echo $amt; ?> /-</label>
							</div>
							<div class="btn-group">
							 <label class="btn btn-primary">Total Upad: <?php echo $upadAmt; ?>/-</label>
							</div>
							<div class="btn-group">
							 <label class="btn btn-primary">Total Due: <?php echo $amt-$upadAmt; ?>/-</label>
							</div>
							
				</div>
			</div>
			<?php
				if(isset($_REQUEST['id']))
				{
					
					//mysql_query("update statement set status='Unpaid' where invoice_id='".$_REQUEST['inv_id']."'");
					mysql_query("delete from statement where st_id='".$_REQUEST['id']."'");
					//header('location:employeeStatement.php');
						echo "<script>window.location='employeeStatement.php'</script>";	
				}
			?>	
			</div>
		</div>
     </div>
	
</div>
</div>

</form>	
</body>
</html>