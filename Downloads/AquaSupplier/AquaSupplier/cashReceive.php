<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

include_once('connection.php');
if (!isset($_SESSION['name'])) {
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
<link href="bootstrap/dist/DateTimePicker.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link href="bootstrap/css/custstyle.css" rel="stylesheet"> 
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="bootstrap/css/w3.css">
	<style>
		.mar{
		margin-top:20px;
		}
	</style>
	
	<script>
 $(document).ready(function()
	{
		$('#txtAmount').focus();
		
		      	
		$( "#txtAmount").keypress(function( event ) {
		if ( event.which == 13) {
			 $('#pay_date').focus();
			 return false;
		  }
		});
		
		$( "#pay_date").keypress(function( event ) {
		if ( event.which == 13) {
			 $('#txtRemark').focus();
			return false;
		  }
		});
		$( "#txtRemark").keypress(function( event ) {
		if ( event.which == 13) {
			 $('#btnsubmit').focus();
			return false;
		  }
		});
		
		$( "#btnsubmit").keypress(function( event ) {
		if ( event.which == 13) {
			
			if($('#txtRemark')=="")
			{
			$('#txtRemark').focus();
			return false;
			}
			
			if($('#pay_date')=="")
			{
			$('#pay_date').focus();
			return false;
			}
			
			if($('#txtAmount')=="")
			{
			$('#txtAmount').focus();
			return false;
			}
			
		  }
		});
		
	});
</script>

	<script type="text/javascript">
	  $(document).ready(function()
	{
		
		$("#bank_id").change(function()
		{
			
			var id=$(this).val();
			var dataString = 'item='+ id;
			$("#getprice").find('option').remove();
			$("#area_list").find('option').remove();
			$.ajax
			({
				type: "POST",
				url: "getBankState.php",
				data: dataString,
				cache: false,
				success: function(html)
				{
				
					$("#getState").html(html);
				} 
			});
		});
		
	});
</script>


 <script>
  $( function() {
    $( "#pay_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>


</head>
<body onkeydown="keyCode(event)">
<?php
	include('sidebarHeader.php');
?>

<form method="POST">
<div id="main" style="margin-left:200px">
	
<div class="w3-container w3-display-container">
		<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
			<div class="modal-content" style="margin-top:50px;">
					<div class="modal-header">
					 <p style="color:#000; font-weight:bold;font-size:15px;">CASH PAYMENT RECEIVED</p>
					</div>
					<div class="modal-body" style="padding:10px 10px;">
						<div class="input-group">
					  <span class="input-group-addon"><b>Amount</b></span>
							<input type="text" name="txtAmount" id="txtAmount" class="form-control" placeholder="Enter Amount"  tabindex="1" value="<?php echo $_REQUEST['amt'];?>" required>
						</div>
						<br>
						<div class="input-group">
					  <span class="input-group-addon"><b>Date</b></span>
			
			<input type="text" class="form-control" name="pay_date" id="pay_date" data-field="date" placeholder="Pay Date" tabindex="2" required />
			</div>
			<br>
			<div class="input-group">
					  <span class="input-group-addon"><b>Remark</b></span>
			
				<input type="text" name="txtRemark" id="txtRemark" class="form-control" placeholder="Cash /  Cheque No"  tabindex="3" required>
			</div>
			<br>
			<div class="form-group">
		
				<input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary pull-right" value="Deposit"  tabindex="4"><br>
				<div class="w3-container">
				<?php
					if(isset($_POST["btnsubmit"]))
					{
					
						$get_date=$_POST['pay_date'];
						$set_date=strtotime($get_date);
						$depDate=date('Y-m-d',$set_date);
						$i=mysql_query("insert into statement(debit,st_date,remark,invoice_id) values('".$_POST['txtAmount']."','$depDate',
						'".strtoupper($_POST['txtRemark'])."','".$_REQUEST['invoiceId']."')");
						
						if($i>0)
									{
										echo "<div class='w3-panel w3-blue'>
												<h3>Success!</h3>
												<p>Amount Recieved Successfuly.</p>
											  </div>";
										//header('refresh:2;url=creditReport.php');
										?>
										<script>
											setTimeout(function () {
											   window.location.href= 'creditReport.php'; // the redirect goes here

											},2000);
										</script>
										<?php
									}
									else
									{
										echo "<div class='w3-panel w3-red'>
										<h3>Error!</h3>
										<p>Error..!!While Recieve Amount.</p>
									  </div>";
									}
						
					}
					?>
				
				
				
				
				</div>
			</div>
					</div>
			 </div>
		
</div>
</div>

	
</form>	
</body>
</html>