<?php
require_once("dbcontroller.php");
date_default_timezone_set("Asia/Calcutta"); 
$db_handle = new DBController();
$_POST['truckID'];
$sql = "SELECT wsm.water_supply_id,cm.customer_name,cm.house_no,cm.customer_address,cm.customer_contact,emp.empName,wsm.supply_date,wsm.supplied_qty,wsm.return_qty,wsm.plan_rate,wsm.deposit_amount,wsm.plan_name from water_supply_master wsm,customer_master cm,tbl_employee emp where wsm.customer_id=cm.customer_id and wsm.empID=emp.empID and wsm.truck_id='".$_POST['truckID']."' and wsm.supply_date='".date('Y-m-d',strtotime($_POST['wsDate']))."'";
$faq = $db_handle->runQuery($sql);
?>
    <head>
      <title>PHP MySQL Inline Editing using jQuery Ajax</title>
	<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>


		<script src="bootstrap/js/jquery-1.10.2.js"></script>
		
		<script>

		function saveToDatabase(editableObj,column,id) {
			 
			$(editableObj).css("background","#fff url(loaderIcon.gif) no-repeat right");

			$.ajax({
				url: "saveeditproduct.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
		</script>
    </head>	
		<div class="w3-responsive">
	   <table class="tbl-qa table w3-table-all w3-small">
		  <thead>
			  <tr class="w3-blue">
				<th class="table-header">#</th>
				<th class="table-header">Customer Name</th>
				
				<th class="table-header">Contact</th>
				<th class="table-header">Address</th>
				<th class="table-header">House No</th>
				<th class="table-header">Emp Name</th>
				<th class="table-header">Plan Name</th>
				
				<th class="table-header">Plan Rate</th>
				<th class="table-header">Supplied QTY</th>
				<th class="table-header">Return QTY</th>
				<th class="table-header">Deposite Amt</th>
				
				<!--<th class="table-header">Action</th>-->
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr class="table-row">		
				<td contenteditable="false"  onBlur="saveToDatabase(this,'water_supply_id','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo ++$count; ?></td>
				<td contenteditable="false" onBlur="saveToDatabase(this,'customer_name','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["customer_name"]; ?></td>
				<td contenteditable="false" onBlur="saveToDatabase(this,'customer_contact','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["customer_contact"]; ?></td>
				<td contenteditable="false" onBlur="saveToDatabase(this,'customer_address','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["customer_address"]; ?></td>
				<td contenteditable="false" onBlur="saveToDatabase(this,'house_no','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["house_no"]; ?></td>
				<td contenteditable="false" onBlur="saveToDatabase(this,'empName','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["empName"]; ?></td>
				<td contenteditable="false" onBlur="saveToDatabase(this,'plan_name','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["plan_name"]; ?></td>
				
				<td contenteditable="false" onBlur="saveToDatabase(this,'plan_rate','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["plan_rate"]; ?></td>
				
				<td contenteditable="true" class="w3-text-red w3-border w3-hover-border-green" onBlur="saveToDatabase(this,'supplied_qty','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["supplied_qty"]; ?></td>
				<td contenteditable="true" class="w3-text-green w3-border w3-hover-border-green" onBlur="saveToDatabase(this,'return_qty','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["return_qty"]; ?></td>
				<td contenteditable="true" class="w3-text-blue w3-border w3-hover-border-green" onBlur="saveToDatabase(this,'deposit_amount','<?php echo $faq[$k]["water_supply_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["deposit_amount"]; ?></td>
			  <!--<td><center><a href="EditProduct.php?id=<?php echo $faq[$k]["water_supply_id"]; ?>" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-edit"></i> </a> </center></td>-->	
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
		</div>
