
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
         <p style="color:#000; font-weight:bold;font-size:17px;">Add New Customer</p>
			<form role="form" method="POST">
			<div class="row">
			
			<div class="col-sm-2">
					Truck No
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
				<div class="col-sm-3">
						Customer Name
					  <input type="text" class="form-control input-sm" name="txtName" id="txtName" placeholder="Enter Customer Name" required tabindex="2" />
					
				</div>
				<div class="col-sm-2">
						Mobile No
					  <input type="text" class="form-control input-sm" placeholder="Mobile No" name="txtContact" id="txtContact"  tabindex="3" />
					
				</div>
				<div class="col-sm-2">
					Card No
						<input type="text" class="form-control input-sm" name="txtHouseNo" id="txtHouseNo" placeholder="Card No" required tabindex="4" />
				
				</div>
				<div class="col-sm-3">
					Address 
              <input type="text" class="form-control input-sm" name="txtAddress" id="txtAddress" placeholder="Enter Address" required tabindex="5" />
           
				</div>
			</div>
			<br>
			<div class="row">
				
				<div class="col-sm-3">
					Product
						
						
						 <select id="txtProductName" name="txtProductName" class="form-control" tabindex="6">
							<?php
								  mysql_query("set names utf8");
								$fetchProduct=mysql_query("SELECT * FROM product_master");
								while($rowProduct=mysql_fetch_array($fetchProduct))
								{
									?>
										<option value="<?php echo $rowProduct[1];?>"><?php echo $rowProduct[1];?></option>
									<?php
								}
							?>							
					 </select>
						
						
						<!--<input type="text" class="form-control input-sm" name="txtProductName" id="txtProductName" placeholder="Product Name" required tabindex="6" />-->
				
				</div>
				<div class="col-sm-2">
					Deposite Amt
						<input type="text" class="form-control input-sm" name="txtDepositeAmt" id="txtDepositeAmt" placeholder="Deposte Amt" required tabindex="7" />
				
				</div>
				<div class="col-sm-2">
					Deposite Type
					 <select id="selDepoType" name="selDepoType" class="form-control" tabindex="8">
						<option value="Cash Sale">Cash Sale</option>	
						<option value="Deposite">Deposite</option>						
					 </select>
					
				</div>
				<div class="col-sm-2">
					Select Plan
					 <select id="selPlan" name="selPlan" class="form-control" tabindex="9">
							<?php
								  mysql_query("set names utf8");
								$fetchPlan=mysql_query("SELECT * FROM plan_master");
								while($rowPlan=mysql_fetch_array($fetchPlan))
								{
									?>
										<option value="<?php echo $rowPlan[0];?>"><?php echo $rowPlan[1];?></option>
									<?php
								}
							?>							
					 </select>
					
				</div>
				<div class="col-sm-2">
					Plan Rate
						<input type="text" class="form-control input-sm" name="txtPlanRate" id="txtPlanRate" placeholder="Plan Rate" required tabindex="10" />
				
				</div>
				<div class="col-sm-1">
					&nbsp;
              <button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="11"><span class="glyphicon glyphicon-plus"></span> Add</button>
           
				</div>
				
			
			</div>
			<div class="row">
				 <?php
						if(isset($_POST['btnSave']))
						{
						$getTruckNo=mysql_query("select truck_id from customer_master where truck_id='".$_POST['selArea']."'");
						while($rowGetTruckNo=mysql_fetch_array($getTruckNo))
						{
							$truck_id=$rowGetTruckNo[0];
						}
						if($truck_id!="")
						{
							$getMaxPos=mysql_query("select MAX(position_order) from customer_master where truck_id='".$_POST['selArea']."'");
							while($rowGetMaxPos=mysql_fetch_array($getMaxPos))
							{
								$pos_order=$rowGetMaxPos[0]+1;
							}
						}
						else
						{
							$pos_order=1;
						}
						
						mysql_query("set names utf8");
						$getPlanName=mysql_query("select plan_name from plan_master where plan_id='".$_POST['selPlan']."'");
						while($rowPlanName=mysql_fetch_array($getPlanName))
						{
							$planName=$rowPlanName[0];
						}
							$i=mysql_query("insert into customer_master (customer_name,customer_contact,customer_address,truck_id,
							position_order,house_no,status,product,deposite_amt,deposite_type,plan_id,plan_rate,plan_name) 
							values ('".$_POST['txtName']."','".$_POST['txtContact']."','".$_POST['txtAddress']."','".$_POST['selArea']."',
							'$pos_order','".$_POST['txtHouseNo']."','deactive','".$_POST['txtProductName']."','".$_POST['txtDepositeAmt']."',
							'".$_POST['selDepoType']."','".$_POST['selPlan']."','".$_POST['txtPlanRate']."','$planName')");
							if($i>0)
							{
										echo "<div class='alert alert-success'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>Customer Record Saved !!</strong>";
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
          </form>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
			<div class="row">
		
		
				<div class="col-sm-12">
					

			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
				<thead>
				<tr class="danger">
					<th>Customer Name</th>
					<th>Contact</th>
					<th>Address</th>
					
					<th>House No</th>
					<th>Plan Name</th>
					<th>Plan Rate</th>
					<th>Product Name</th>
					<th>Deposite Amt</th>
					<th>Deposte Type</th>
					<th><center>Action</center></th>
				</tr>
				</thead>
				<?php
				mysql_query("set names utf8");
					$result=mysql_query("select cm.customer_id,cm.customer_name,cm.customer_contact,cm.customer_address,
					cm.house_no,cm.product,cm.deposite_amt,cm.deposite_type,pm.plan_name,cm.plan_rate from customer_master cm,truck_master tm,plan_master pm where pm.plan_id=cm.plan_id and cm.truck_id=tm.truck_id");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $row['customer_name']; ?></td>
							<td><?php echo $row['customer_contact']; ?></td>
							<td><?php echo $row['customer_address']; ?></td>
							
							<td><?php echo $row['house_no']; ?></td>
							<td><?php echo $row['plan_name']; ?></td>
							<td><?php echo $row['plan_rate']; ?></td>
							<td><?php echo $row['product']; ?></td>
							<td><?php echo $row['deposite_amt']; ?></td>
							<td><?php echo $row['deposite_type']; ?></td>
							
							<td><center><a href="EditCustomer.php?custID=<?php echo $row[0]; ?>" style="color:#1B5E20;" > Edit </a> | <a href="?id=<?php echo $row[0]; ?>" onClick="return confirm('Are You Sure?')" style="color:#E91E63;" > Delete </a></center></td>	
						</tr>
						<?php
					}
				?>	
			</table>
				</div>
			<?php
				if(isset($_REQUEST['id']))
				{
					//mysql_query("delete from customer_master where customer_id='".$_REQUEST['id']."'");
					mysql_query("update customer_master set status='deactive' where customer_id='".$_REQUEST['id']."'");
				echo "<script>window.location='AddCustomer.php'</script>";		
					//header('location:AddCustomer.php');
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