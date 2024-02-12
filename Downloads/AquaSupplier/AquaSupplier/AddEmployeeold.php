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
<title>Add New Employee</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
<form  method="POST">

<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
		<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
		
         <p style="color:#000; font-weight:bold;font-size:15px;">ADD EMPLOYEE</p>
		
		 <div class="row">
		  
			<div class="col-sm-3">
			<div class="form-group">
					  Employee Name
					<input type="text" name="txt_employee_name" id="txt_employee_name" placeholder="Employee Name" class="form-control input-sm" required tabindex="1"/>
			</div>		  
			</div>
			
			<div class="col-sm-3">	
			<div class="form-group">
					  Address		
					<input type="text" name="txt_address" id="txt_address" class="form-control input-sm" placeholder="Address" tabindex="2"/>
			</div>
			</div>
			
			<div class="col-sm-2">
			<div class="form-group">
					  Contact
					<input type="text" name="txt_product_contact" maxlength="13" id="txt_product_contact" class="form-control input-sm" placeholder="Contact Number" tabindex="3" />
				</div>	 
			</div>
			<div class="col-sm-2">
					<div class="form-group">
					  Daily Sal
						<input type="text" name="txt_SalAmount" id="txt_SalAmount" class="form-control input-sm" placeholder="Rs" required tabindex="4" />
					</div>
			</div>
			<div class="col-sm-2">
					<div class="form-group">
						Designation
						<select name="desType" id="desType" class="form-control" tabindex="5">
							<option value="Employee">Employee</option>
							<option value="Driver">Driver</option>
						</select>
					</div>
			</div>
			<div class="col-sm-1">
					
						<button type="submit" class="btn btn-primary" name="btnProduct" id="btnProduct" tabindex="6"><span class="glyphicon glyphicon-plus"></span> Add</button>
					
			</div>
			
		</div>
		 <div class="row">
			<?php
				if(isset($_POST['btnProduct']))
				{
								
								
						mysql_query("set names utf8");
					$i=mysql_query("INSERT INTO tbl_employee(empName,address,contact,salaryAmount,designation) VALUES ('".strtoupper($_POST['txt_employee_name'])."','".strtoupper($_POST['txt_address'])."','".$_POST['txt_product_contact']."','".$_POST['txt_SalAmount']."','".$_POST['desType']."')");
					if($i>0)
					{
						echo "<div class='alert alert-success'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>Employee Record Saved !!</strong>";
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
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		<div class="row">
	
		
		<div class="col-sm-12">
			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
		<thead>
		<tr class="danger">
		    <th>Emp Id </th>
			<th>Employee Name</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Daily Salary Amount</th>
			
			
			<th><center>Action</center></th>
		</tr>
		</thead>
		<?php
			mysql_query("set names utf8");
			$result=mysql_query("select * from tbl_employee");
			while($row=mysql_fetch_array($result))
			{
				?>
				<tr>
				    	<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><center><a href="editEmployee.php?id=<?php echo $row[0]; ?>" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-edit"></i> </a> | <a id="delete_employee"  href="?deleteID=<?php echo $row[0]; ?>" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"></i> </a></center></td>	
				</tr>
				<?php
			}
		?>	
			</table>
		</div>
		</div>
		</div>
      </div>
	
</div>
</div>
<?php
	if(isset($_REQUEST['deleteID']))
	{
		mysql_query("delete from tbl_employee where empID='".$_REQUEST['deleteID']."'");
		echo "<script>window.location='AddEmployee.php'</script>";
	}
?>
	
<script>
$(document).ready(function(){
	$('#productData').DataTable();
});
</script>
</form>	
</body>
</html>