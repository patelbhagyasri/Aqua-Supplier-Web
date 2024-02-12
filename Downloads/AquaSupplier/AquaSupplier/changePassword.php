<?php
include_once('connection.php');
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
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link href="bootstrap/css/custstyle.css" rel="stylesheet"> 
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
 <script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script>

<script src="bootstrap/swal/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="bootstrap/swal/sweetalert2.common.js" type="text/javascript"></script>

<link href="bootstrap/swal/sweetalert2.css" rel="stylesheet" type="text/css" />	

<script src="bootstrap/swal/sweetalert2.js" type="text/javascript"></script>

<link href="bootstrap/swal/sweetalert2.min.css" rel="stylesheet" type="text/css" />	

<script src="bootstrap/swal/sweetalert2.min.js" type="text/javascript"></script>
	<style>
		.mar{
		margin-top:20px;
		}
	</style>
<script>
 $(document).ready(function()
	{
		
		   
		
		$( "#txtOldPass").keypress(function( event ) {
		  if ( event.which == 13) {
			 $('#txtNewPass').focus();
			return false;
		  }
		});	
		$( "#txtNewPass").keypress(function( event ) {
		  if ( event.which == 13) {
			 $('#txtConfirmPass').focus();
			return false;
		  }
		});	
		$( "#txtConfirmPass").keypress(function( event ) {
		  if ( event.which == 13) {
			 $('#btnChange').focus();
			return false;
		  }
		});	
		$( "#btnChange").keypress(function( event ) {
		  if ( event.which == 13) {
			 if($('#txtOldPass')=="")
			 {
				 $('#txtOldPass').focus();
			    return false;
			 }
			  if($('#txtNewPass')=="")
			 {
				 $('#txtNewPass').focus();
			    return false;
			 }
			  if($('#txtConfirmPass')=="")
			 {
				 $('#txtConfirmPass').focus();
			    return false;
			 }
		  }
		});	
		
	});
</script>
</head>
<body onkeydown="keyCode(event)">

<form method="POST">


	<!-- Main Body Starts -->
	
<div class="container-fluid" style="margin-top:10px;">
<div class="row">
	<div class="col-sm-10">
	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6" style="margin-top:160px;">
		
		<div class="modal-content">
				<div class="modal-header">
				 <p style="color:#000; font-weight:bold;font-size:15px;">CHANGE PASSWORD</p>
				</div>
				<div class="modal-body" style="padding:10px 10px;">
					<br>
					<div class="input-group">
					  <span class="input-group-addon"><b>Old Password</b></span>
				<input type="text" class="form-control" name="txtOldPass" id="txtOldPass" placeholder="Old Password" required autofocus />
				</div>
				<br> 
				
					<div class="input-group">
					  <span class="input-group-addon"><b>New Password</b></span>
				<input type="text" class="form-control" name="txtNewPass" id="txtNewPass" required placeholder="New Password"/>
				</div>
				<br>
					<div class="input-group">
					  <span class="input-group-addon"><b>Confirm Password</b></span>
				<input type="text" class="form-control" name="txtConfirmPass" id="txtConfirmPass" required placeholder="Confirm Password"/>
				</div>
			<div class="form-group">
			<br>
			<input type="submit" class="btn btn-primary pull-right" name="btnChange" id="btnChange" value="Change Password"/>
			</div>
			
			<br>
			<br>
			<?php
					if(isset($_POST['btnChange']))
					{
						if($_POST['txtNewPass']==$_POST['txtConfirmPass'])
						{
						mysql_query("update login set usl_password='".$_POST['txtNewPass']."' where usl_password='".$_POST['txtOldPass']."' and usl_user='".$_SESSION['name']."'");
						if(mysql_affected_rows()>0)
						{
										?>
										<script>
											swal({
												 title: "Change Password Successfuly!",
												 
												 type: "success",
												 timer: 1000
												 },
												 function () {
														location.reload(true);
														tr.hide();
												 });
										</script>
										
										<?php
										//header('refresh:2;url=index.php');
										echo "<script>window.location='index.php'</script>";
									}
									else
									{
										?>
										<script>
											swal({
												 title: "Error!",
												 text:"Something goes wrong",
												 type: "error",
												 timer: 1000
												 },
												 function () {
														location.reload(true);
														tr.hide();
												 });
										</script>
										
										<?php
										//header('refresh:2;url=changePassword.php');
									echo "<script>window.location='index.php'</script>";
									}
									
									
						}
						else
						{
							?>
										<script>
											swal({
												 title: "Error!",
												 text:"Confirm Password does't Match",
												 type: "error",
												 timer: 2000
												 },
												 function () {
														location.reload(true);
														tr.hide();
												 });
										</script>
										
										<?php
										//header('refresh:2;url=changePassword.php');
						echo "<script>window.location='index.php'</script>";
						}
					
					}
					?>
				</div>
		</div>
		
		
			
				
				
			
		</div>
		
		<div class="col-sm-4">
			
		</div>
			
		
		</div>

	</div>
	<div class="col-sm-2">
	<?php
		include('sidemenu.php');
	?>
	</div>
</div>
		
	</div>	
	

</div>

</form>	
</body>
</html>