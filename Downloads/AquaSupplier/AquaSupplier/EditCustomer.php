
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
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">	
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
	
         <p style="color:#000; font-weight:bold;font-size:17px;">Edit Customer</p>
			<form role="form" method="POST">
			<div class="row">
			<?php 
			mysql_query("set names utf8");
			$resDriver=mysql_query("select * from customer_master where customer_id='".$_REQUEST['custID']."'");
			while($rowDriver=mysql_fetch_array($resDriver))
			{
				$driverName=$rowDriver['customer_name'];
				$driverContact=$rowDriver['customer_contact'];
				$driverAddress=$rowDriver['customer_address'];
				$truckNo=$rowDriver['truck_id'];
				$houseNo=$rowDriver['house_no'];
				$product=$rowDriver['product'];
				$deposite_amt=$rowDriver['deposite_amt'];
				$deposite_type=$rowDriver['deposite_type'];
				$plan_id=$rowDriver['plan_id'];
				$planRate=$rowDriver['plan_rate'];
				//$positionOrder=$rowDriver['position_order'];
				//$password=$rowDriver['driver_address'];
			}
		?>
			<div class="col-sm-2">
					Truck No
					 <select id="selArea" name="selArea" class="form-control" tabindex="1">
							
							<?php
								$fetchTruct=mysql_query("SELECT * FROM truck_master where truck_id='$truckNo'");
								while($rowTruct=mysql_fetch_array($fetchTruct))
								{
									?>
										<option value="<?php echo $rowTruct[0];?>"><?php echo $rowTruct[1];?></option>
									<?php
								}								
								$fetchArea=mysql_query("SELECT * FROM truck_master");
								while($rowFetchArea=mysql_fetch_array($fetchArea))
								{
									?>
										<option value="<?php echo $rowFetchArea[0];?>" ><?php echo $rowFetchArea[1];?></option>
									<?php
								}
							?>							
					 </select>
					
				</div>
				<div class="col-sm-3">
					Customer Name
					  <input type="text" class="form-control input-sm" name="txtName" value="<?php echo $driverName; ?>" id="txtName" placeholder="Enter Customer Name" required tabindex="2" />
					
				</div>
				<div class="col-sm-2">
					Mob No
					  <input type="text" class="form-control input-sm" placeholder="Mobile No" value="<?php echo $driverContact; ?>" name="txtContact" id="txtContact"  tabindex="3" />					
				</div>
				<div class="col-sm-2">
					House No
						<input type="text" class="form-control input-sm" name="txtHouseNo" id="txtHouseNo" value="<?php echo $houseNo; ?>" placeholder="House No" required tabindex="4" />
				
				</div>
				<div class="col-sm-3">
					Address
				<input type="text" class="form-control input-sm" name="txtAddress" id="txtAddress" value="<?php echo $driverAddress; ?>" placeholder="Enter Address" required tabindex="5" />          
				</div>
			</div>
			<br>
			<div class="row">
				
				<div class="col-sm-3">
					Product
						<input type="text" class="form-control input-sm" name="txtProductName" id="txtProductName" value="<?php echo $product; ?>" placeholder="Product Name" required tabindex="6" />
				
				</div>
				<div class="col-sm-2">
					Deposite Amt
						<input type="text" class="form-control input-sm" name="txtDepositeAmt" id="txtDepositeAmt" value="<?php echo $deposite_amt; ?>" placeholder="Deposte Amt" required tabindex="7" />
				
				</div>
				<div class="col-sm-2">
					Deposite Type
					 <select id="selDepoType" name="selDepoType" class="form-control" tabindex="8">
						<option value="<?php echo $deposite_type; ?>"><?php echo $deposite_type; ?></option>	
						<option value="Cash Sale">Cash Sale</option>	
						<option value="Deposite">Deposite</option>						
					 </select>
					
				</div>
				<div class="col-sm-2">
					Select Plan
					 <select id="selPlan" name="selPlan" class="form-control" tabindex="9">
							<?php
								  mysql_query("set names utf8");
								  $selPlan=mysql_query("SELECT * FROM plan_master where plan_id='$plan_id'");
								while($rowUPlan=mysql_fetch_array($selPlan))
								{
									?>
										<option value="<?php echo $rowUPlan[0];?>"><?php echo $rowUPlan[1];?></option>
									<?php
								}
								
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
						<input type="text" class="form-control input-sm" name="txtPlanRate" id="txtPlanRate" value="<?php echo $planRate; ?>" placeholder="Plan Rate" required tabindex="10" />
				
				</div>
				<div class="col-sm-2">
					<label></label>
              <button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="10"><span class="glyphicon glyphicon-pencil"></span> Update</button>
           
				</div>
				
				<div class="col-sm-2">
					
			</div>
			</div>
			<div class="row">
				 <?php
						if(isset($_POST['btnSave']))
						{
						
						mysql_query("set names utf8");
						$getPlanName=mysql_query("select plan_name from plan_master where plan_id='".$_POST['selPlan']."'");
						while($rowPlanName=mysql_fetch_array($getPlanName))
						{
							$planName=$rowPlanName[0];
						}
							//$i=mysql_query("insert into customer_master (customer_name,customer_contact,customer_address,truck_id,position_order) values ('".$_POST['txtName']."','".$_POST['txtContact']."','".$_POST['txtAddress']."','".$_POST['selArea']."','$pos_order')");
							$i=mysql_query("update customer_master set customer_name='".$_POST['txtName']."',customer_contact='".$_POST['txtContact']."',
							customer_address='".$_POST['txtAddress']."',truck_id='".$_POST['selArea']."',
							house_no='".$_POST['txtHouseNo']."',product='".$_POST['txtProductName']."',deposite_amt='".$_POST['txtDepositeAmt']."',
							deposite_type='".$_POST['selDepoType']."',plan_id='".$_POST['selPlan']."',plan_rate='".$_POST['txtPlanRate']."',plan_name='$planName'
							where customer_id='".$_REQUEST['custID']."'");
							if($i>0)
							{
										echo "<script>window.location='AddCustomer.php'</script>";	
										
									}
									else
									{
										echo "<div class='alert alert-danger'>";
										echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
										echo "<strong>ERROR !!</strong>";
										echo"</div>";
									}
						}
					  ?>
			</div>
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