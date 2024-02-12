<?php
include_once('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Employee Advance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<link href="bootstrap/css/font.css" rel="stylesheet"> 
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="bootstrap/js/page.js" type="text/javascript"></script>
 <script type="text/javascript">
	   $(function() {
						$( "#advance_date" ).datepicker();
					});

</script>
	<style>
		.mar{
		margin-top:20px;
		}
	</style>
<script>
$(document).ready(function(){	
	$("#select_Advance_Employee").focus();
	
});
</script>
</head>
<body onkeydown="keyCode(event)">
<?php
	if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
?>
<form method="POST" enctype="multipart/form-data">
<?php
include('menu.php');
?>
	<!-- Main Body Starts -->
<div class="container mar">
	<div class="row">
		
		<div class="col-sm-4 well">
				<div class="form-group">
				  <label>Select Employee :</label>
					<select class="form-control" name="select_Advance_Employee" id="select_Advance_Employee" tabindex="1">
						<?php
							mysql_query("set names utf8");
							$selemp=mysql_query("select * from employee");
							while($rowemp=mysql_fetch_array($selemp))
							{
						?>
							<option value="<?php echo $rowemp[0]; ?>"><?php echo $rowemp['name']; ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Amount :</label>
					<input type="text" name="txtAdvanceAmount" class="form-control" placeholder="Enter Amount" tabindex="2" required/>
				</div>
			
			<div class="form-group row">
			
				<div class="col-sm-6">
								<div class="form-group">
									<label>Date :</label>
									<input type="text" class="form-control" id="advance_date" tabindex="3" name="advance_date" placeholder="Date" required />
								</div>
				</div>
				<div class="col-sm-6">
				&nbsp;
				<input type="submit" name="btnAdvancePay" value="Pay Advance" class="btn btn-info pull-right" style="width:100%;" tabindex="4"/><br><br>
				</div>
			</div>
			<?php
				if(isset($_POST['btnAdvancePay']))
				{
					$get_datea=$_POST['advance_date'];
								$set_datea=strtotime($get_datea);
								$advance_date=date('Y-m-d',$set_datea);
									mysql_query("set names utf8");
					mysql_query("INSERT INTO employee_advance(emp_id,advance_amount,advance_date) VALUES ('".$_POST['select_Advance_Employee']."','".$_POST['txtAdvanceAmount']."','$advance_date')");
					if ( mysql_insert_id() > 0 )
					{
						echo "<div class='alert alert-success'>";
						echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
						echo "<strong>Advanced Payment Successfuly!!</strong>";
						echo"</div>";
					}	
					else
					{
						echo "<div class='alert alert-danger'>";
						echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
						echo "<strong>ERROR!!</strong>";
						echo"</div>";
					}
				}
?>
		</div>
		
		<div class="col-sm-8">
			<table class="table table-responsive">
		<tr class="info">
			<th>Employee Name</th>
			<th>Amount</th>
			<th>Date</th>
			<th><center>Action</center></th>
		</tr>
		<?php
			mysql_query("set names utf8");
			$result=mysql_query("select ad.advance_id,emp.name,ad.advance_amount,ad.advance_date from employee_advance ad,employee emp where emp.emp_id=ad.emp_id ORDER BY ad.advance_id DESC");
			while($row=mysql_fetch_array($result))
			{
				?>
				<tr>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo date('d-m-Y',strtotime($row[3]));?></td>
					<td><center><a href="EditAdvance.php?id=<?php echo $row[0]; ?>" class="btn btn-info" > Edit </a> | <a href="?advanceid=<?php echo $row[0]; ?>" class="btn btn-danger" onClick="return confirm('Are You Sure?')" > Delete </a></center></td>	
					
				</tr>
				
				<?php
			}
		?>	
			</table>
		</div>
		</div>
		

		<?php
		if(isset($_REQUEST['advanceid']))
		{
			mysql_query("delete from employee_advance where advance_id='".$_REQUEST['advanceid']."'");
			//header('location:empAdvance.php');
				echo "<script>window.location='empAdvance.php'</script>";	
		}
	?>	
			
	</div>
	
	
	<!-- Divisiuon for php code to insert Data-->
	
	<div class="row">
		
		<div class="col-sm-8">
			
		</div>
		<div class="col-sm-4">
			
	</div>
	
	
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</form>	
</body>
</html>