<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
			<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
				<script src="bootstrap/js/bootstrap.min.js"></script>
				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
				<style>
					.mar
					{
						margin-top:120px;
					}
				</style>
				
				 <script>
					   history.pushState(null, null, document.title);
					   window.addEventListener('popstate', function () {
					   history.pushState(null, null, document.title);
						});
				</script>
				
	</head>
	<body>
	<form  method="POST">
		<div class="container mar">
			<div class="row">
				<div class="col-sm-4">	</div>
		
				<div class="col-sm-4 well">
					<div class="form-group">
					<table class="table">
						<tr style="background-color:#2cad6b;color:#fff"><td><Label><h3>Login Area</h3></label></td></tr>
					</table>
					
					<hr>
					</div>
					<div class="form-group">
					<label>User Name :</label>
						<input type="text" name="vdn_user" class="form-control"  required/>
					</div>
					<div class="form-group">
					<label>Password :</label>
						<input type="password" name="txt_vdn_pass" class="form-control"  required/>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary pull-right" value="Login"/>
					</div>
				</div>
				
				<div class="col-sm-4"> 


				<?php
					if(isset($_POST['submit']))
					{
						$con = mysqli_connect("localhost", "root","","aquasupplier") or die(mysqli_error($con));
						$vdn_admin = mysqli_real_escape_string($con,$_POST['vdn_user']);
						$vdn_pass = mysqli_real_escape_string($con,$_POST['txt_vdn_pass']);
						$result = mysqli_query($con,"CALL AndroidLoginP('$vdn_admin','$vdn_pass',@stat)" ) or die(mysqli_error($con));
						$result = mysqli_query($con,'select @stat' );
						while($row = mysqli_fetch_array($result))
						{
							$count = $row[0];
							if($count==1)
							{
								$_SESSION['name']=$_POST['vdn_user'];
								echo "<script>window.location='home.php'</script>";
							}
							else 
							{
								//header('location:index.php');
								echo "<script>window.location='index.php'</script>";
								if(($_POST['vdn_user']=="1'or'1'='1") && ($_POST['txt_vdn_pass']=="1'or'1'='1"))
								{
									echo "You IP Has been added as hacker..... Be Careful Now";
								}
								else
								{
									echo "Invalid username or password";
								}
							}
						}
					
						
					}
				?>

				</div>		
				
			</div>
	
		</div>
	</form>	 
	</body>
</html>