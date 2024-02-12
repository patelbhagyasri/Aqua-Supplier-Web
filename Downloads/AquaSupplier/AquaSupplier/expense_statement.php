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
<!-- css -->
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

<form action="" method="POST">
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">		
         <p style="color:#000; font-weight:bold;font-size:17px;">Expense Statement</p>
			 <div class="row">
				  <form method="POST">
					<div class="col-sm-3">
						 <select class="form-control"  name="selCom" id="selCom" tabindex="1">
										<option value="all">------------------ All ---------------</option>
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
					<div class="col-sm-3">
						<input type="text" name="start_date" id="start_date"  class="form-control" placeholder="Start Date" tabindex="2" required />
					</div>
					
					<div class="col-sm-3">
					<input type="text" name="end_date" id="end_date" class="form-control" placeholder="End Date" tabindex="3" required />
					</div>
					<div class="col-sm-2">
						<input type="submit" name="btnSearch" id="btnSearch" class="btn btn-danger" value="Expense Statement" tabindex="4" />
					</div>
					</form>
				 </div>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
		
					<div class="row">
		
				<div class="col-sm-12">
					

			<table class="table table-bordered">
				<tr>
					<th>Sr No</th>
					<th>Expense Name</th>
					<th>Amount</th>
					<th>Date</th>
					<th>Remark</th>					
					<th>Truck No</th>					
					<th><center>Action</center></th>
				</tr>
				<?php
					if(isset($_POST['btnSearch']))
					{
					
					$d1=strtotime($_POST['start_date']);
					$dd1=date('Y-m-d',$d1);
					$d2=strtotime($_POST['end_date']);
					$dd2=date('Y-m-d',$d2);
					if($_POST['selCom']=="all")
					{
						$result=mysql_query("select es.ex_st_id,e.ex_name,es.amount,es.ex_date,es.remark,es.truck_id from expense_statement es,tbl_expense e where es.ex_id=e.ex_id AND es.ex_date BETWEEN '$dd1' AND '$dd2'");
					}
					else
					{
						$result=mysql_query("select es.ex_st_id,e.ex_name,es.amount,es.ex_date,es.remark,es.truck_id from expense_statement es,tbl_expense e where es.ex_id=e.ex_id and es.ex_id='".$_POST['selCom']."' AND es.ex_date BETWEEN '$dd1' AND '$dd2'");
					}
					
						
					$count=1;
					while($row=mysql_fetch_array($result))
					{
						$date1=strtotime($row[3]);
						$datee1=date('d-M-Y',$date1);
						?>
						<tr>
							<td><?php echo $count++; ?></td>
							<td><?php echo $row[1]; ?></td>
							<td><?php echo $row[2]; ?></td>
							<td><?php echo $datee1; ?></td>
							<td><?php echo $row[4]; ?></td>
							<td><?php 
							$resTruck=mysql_query("select * from truck_master where truck_id='$row[5]'");
							while($rowTruck=mysql_fetch_array($resTruck))
							{
								echo $rowTruck[1];
							}
							 ?></td>
							<td><center><a href="?id=<?php echo $row[0]; ?>" class="btn btn-danger" onClick="return confirm('Are You Sure?')" > Delete </a></center></td>	
						</tr>
						<?php
					}
					
					if($_POST['selCom']=="all")
					{
						$result1=mysql_query("select sum(amount) from expense_statement where ex_date BETWEEN '$dd1' AND '$dd2'");
					}
					else
					{
						$result1=mysql_query("select sum(amount) from expense_statement where ex_id='".$_POST['selCom']."' AND ex_date BETWEEN '$dd1' AND '$dd2'");
					}
					
					
					while($row1=mysql_fetch_array($result1))
					{
						$amt=$row1[0];						
					}
				}
				?>	
				
				
				
			</table>
			<div class="container-fluid">
				<div class="btn-group btn-group-justified">
							<div class="btn-group">
							 <label class="btn btn-primary">Total : <?php echo $amt; ?> /-</label>
							</div>
							
				</div>
			</div>
				</div>
			<?php
				if(isset($_REQUEST['id']))
				{
					
					//mysql_query("update statement set status='Unpaid' where invoice_id='".$_REQUEST['inv_id']."'");
					mysql_query("delete from expense_statement where ex_st_id='".$_REQUEST['id']."'");
					
					echo "<script>window.location='expense_statement.php'</script>";		
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