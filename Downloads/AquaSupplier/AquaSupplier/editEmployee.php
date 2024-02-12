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
<?php

if(isset($_REQUEST['id']))
		{
			mysql_query("set names utf8");
			$result=mysql_query("select * from tbl_employee where empID='".$_REQUEST['id']."'");
			while($row=mysql_fetch_array($result))
			{
				$empName=$row[1];
				$address=$row[2];
				$contact=$row[3];
				$salAmt=$row[4];
				$designation=$row[5];
				
			}
			
		}
?>
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
		<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
		<?php
			//include('menu.php');
		?>
         <p style="color:#000000; font-weight:bold;font-size:20px;">Edit Employee</p>
		
		 <div class="row">
		  
			<div class="col-sm-2 text-left">
					<b style="font-size:12px;" >Employee Name</b>
					<input type="text" name="txt_employee_name" id="txt_employee_name" placeholder="Employee Name" class="form-control" value="<?php echo $empName; ?>" required tabindex="1"/>
					  
			</div>
			
			<div class="col-sm-3 text-left">
					<b style="font-size:12px;" >Address</b>
					<input type="text" name="txt_address" id="txt_address" class="form-control" placeholder="Address" value="<?php echo $address; ?>" tabindex="2"/>
			</div>
			
			<div class="col-sm-2 text-left">
						<b style="font-size:12px;" >Contact</b>
					<input type="text" name="txt_product_contact" maxlength="13" id="txt_product_contact" class="form-control" value="<?php echo $contact; ?>" placeholder="Contact Number" tabindex="3" />
					 
			</div>
			<div class="col-sm-2 text-left">
						<b style="font-size:12px;" >Daily Salary Amount</b>
						<input type="text" name="txt_SalAmount" id="txt_SalAmount" class="form-control" placeholder="Daily Salary Amount" value="<?php echo $salAmt; ?>" required tabindex="4" />
					
			</div>
			<div class="col-sm-2">
					<div class="form-group">
						Designation
						<select name="desType" id="desType" class="form-control" tabindex="5">
							<option value="<?php echo $designation; ?>"><?php echo $designation; ?></option>
							<option value="Employee">Employee</option>
							<option value="Driver">Driver</option>
						</select>
					</div>
			</div>
			<div class="col-sm-2">
						</br>
						<button type="submit" class="btn btn-primary btn-block" name="btnProduct" id="btnProduct" tabindex="5"><span class="glyphicon glyphicon-pencil"></span> Update Employee</button>
			</div>  
					 <?php
				if(isset($_POST['btnProduct']))
				{
					mysql_query("set names utf8");
					mysql_query("Update tbl_employee SET empName='".strtoupper($_POST['txt_employee_name'])."',address='".strtoupper($_POST['txt_address'])."',contact='".$_POST['txt_product_contact']."',salaryAmount='".$_POST['txt_SalAmount']."',designation='".$_POST['desType']."' where empID='".$_REQUEST['id']."' ");
					//header('location:AddEmployee.php');
						echo "<script>window.location='AddEmployee.php'</script>";	
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