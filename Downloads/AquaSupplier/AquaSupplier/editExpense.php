
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

<!-- css -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<link href="bootstrap/css/font.css" rel="stylesheet"> 
<link href="bootstrap/css/custstyle.css" rel="stylesheet">
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="bootstrap/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="bootstrap/DataTables/js/datatables.bootstrap.min.js" type="text/javascript"></script>
<link href="bootstrap/DataTables/css/datatables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="bootstrap/swal/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="bootstrap/swal/sweetalert2.common.js" type="text/javascript"></script>
<link href="bootstrap/swal/sweetalert2.css" rel="stylesheet" type="text/css" />	
<script src="bootstrap/swal/sweetalert2.js" type="text/javascript"></script>
<link href="bootstrap/swal/sweetalert2.min.css" rel="stylesheet" type="text/css" />	
<script src="bootstrap/swal/sweetalert2.min.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script> 
	<style>
		.mar{
		margin-top:20px;
		}
	</style>
	<script>
 $(document).ready(function()
	{
		 
		$('#txtName').focus();
		
		  
		
		$( "#txtName").keypress(function( event ) {
		  if ( event.which == 13) {
			 $('#btnSave').focus();
			return false;
		  }
		
		});		
		
		$( "#btnSave").keypress(function( event ) {
		if ( event.which == 13) {
			
			if($('#txtName')=="")
			{
			$('#txtName').focus();
			return false;
			}
		
		  }
		});
		
	});
</script>

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
<body style="color:black; font-family:Arial;">
<?php
			include('menu.php');
		?>
<form action="" method="POST">

	<!-- Main Body Starts -->
<div class="container-fluid mar">
<div class="row">
	<div class="col-sm-10">
	<div class="modal-content">
        <div class="modal-header">
		<?php
			mysql_query("set names utf8");
					$result=mysql_query("select * from tbl_expense where ex_id='".$_REQUEST['id']."'");
					while($row=mysql_fetch_array($result))
					{
								$expenseName=$row[1];
					}
		?>	
				
         <p style="color:#000; font-weight:bold;font-size:15px;">Edit EXPENSE</p>
			<form role="form" method="POST">
			<div class="row">
				<div class="col-sm-6">
					
					  <input type="text" class="form-control input-sm" name="txtName" id="txtName" value="<?php echo $expenseName; ?>" placeholder="Expense Name" required tabindex="1" />
					
				</div>
				
			<div class="col-sm-2">
              <button type="submit" class="btn btn-danger btn-block" name="btnSave" id="btnSave" tabindex="7"><span class="glyphicon glyphicon-pencil"></span> Update Expense</button>
           
			</div>
				
				<div class="col-sm-3">
					 <?php
						if(isset($_POST['btnSave']))
						{
						    	mysql_query("set names utf8");
							$i=mysql_query("update tbl_expense set ex_name='".strtoupper($_POST['txtName'])."' where ex_id='".$_REQUEST['id']."'"); 
							//$i=mysql_query("insert into tbl_expense(ex_name) values ('".strtoupper($_POST['txtName'])."')"); 
							
							if($i>0)
							{
								?>
										<script>
											swal({
												 title: "Expense Name Updated!",
												 
												 type: "success",
												 timer: 1000
												 },
												 function () {
														location.reload(true);
														tr.hide();
												 });
										</script>
										<?php
										//header("refresh:1;addExpense.php");
										echo "<script>window.location='addExpense.php'</script>";
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
          </form>
        </div>
		<div class="modal-body" style="padding:10px 10px;">
			
		</div>
 </div>
	</div>
	<div class="col-sm-2">
		<?php
			include ("sidemenu.php");
		?>
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
