
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

<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
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
		
         <p style="color:#000; font-weight:bold;font-size:15px;">Add Expense</p>
			<form role="form" method="POST">
			<div class="row">
				<div class="col-sm-2">
				<div class="form-group">
					  <b>Expense Name</b>
					  <select class="form-control input-sm" id="selExpense" name="selExpense" tabindex="1" autofocus required>
							<option value="">-- Expense Name --</option>
						<?php
							$selcom=mysql_query("select * from tbl_expense");
							while($row=mysql_fetch_array($selcom))
							{
						?>
							<option value="<?php echo $row['ex_id']; ?>"><?php echo $row['ex_name']; ?></option>
						<?php
							}
						?>
						</select> 
					</div>
				</div>
				<div class="col-sm-2">
				<div class="form-group">
					<b>Truck No</b>
					 <select id="selTruck" name="selTruck" class="form-control input-sm" tabindex="1">
							<option>--Select Truck--</option>
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
				</div>
				<div class="col-sm-2">
					<div class="form-group">
					  <b>Date</b>
					  <input type="text" class="form-control input-sm" placeholder="Date" name="txtDate" id="txtDate" required  tabindex="2" />
					</div>
				</div>
				
				
				<div class="col-sm-2">
					<div class="form-group">
					  <b>Amount</b>
						<input type="text" class="form-control input-sm" name="txtAmount" id="txtAmount" placeholder="Amount" tabindex="4" />
           
				</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
					  <b>Remark</b>
						<input type="text" class="form-control input-sm" name="txtRemark" id="txtRemark" placeholder="Remark" tabindex="4" />
           
				</div>
				</div>
				<div class="col-sm-1">
				<br>
				<button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="8"><span class="glyphicon glyphicon-plus"></span> Add</button>
           
				</div>
					
				
			</div>
			
			<div class="row">
			
				
				
				<div class="col-sm-3">
					 <?php
						if(isset($_POST['btnSave']))
						{		
							
							$i=mysql_query("insert into expense_statement(ex_id,ex_date,amount,remark,truck_id) 
							values ('".$_POST['selExpense']."','".date('Y-m-d',strtotime($_POST['txtDate']))."','".$_POST['txtAmount']."',
							'".$_POST['txtRemark']."','".$_REQUEST['selTruck']."')");
							if($i>0)
							{
								?>
										<script>
											swal({
												 title: "Expense Statement Added!",
												 
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
												 text:"Something goes wrong.!",
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
        <br>
          </form>
		
        </div>
		<div class="modal-body" style="padding:10px 10px;">
			<div class="row">
		
		
				<div class="col-sm-12">
					

			<table class="table table-bordered" style="font-size:12px; font-weight:bold;" id="productData">
				<thead>
				<tr class="danger">
					<th>Expense Name</th>
					<th>Amount</th>			
					<th>Expense Date</th>
					<th>Remark</th>
					
					<th><center>Action</center></th>
				</tr>
				</thead>
				<?php
					$result=mysql_query("select es.ex_st_id,e.ex_name,es.amount,es.ex_date,es.remark from expense_statement es,tbl_expense e where e.ex_id=es.ex_id");
					while($row=mysql_fetch_array($result))
					{
						?>
						<tr>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							
							<td><?php echo date('d-M-Y',strtotime($row[3])); ?></td>
							<td><?php echo $row[4]; ?></td>
							
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
					mysql_query("delete from expense_statement where ex_st_id='".$_REQUEST['id']."'");
					header('location:Add_ExpenseStatement.php');
				}
			?>	
			</div>
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