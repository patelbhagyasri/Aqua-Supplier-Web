<?php
include_once('connection.php');
date_default_timezone_set("Asia/Calcutta"); 
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order_info</title>
<link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="bootstrap/js/bootstrap3-typeahead.min.js"></script> 

<link type="text/css" href="bootstrap/css/bootstrap-timepicker.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap-timepicker.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
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
	<script>
$(document).ready(function(){
 
 $('#txt_product_name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetchPlanName.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
	
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
	  
   })
  }

 });
 
});
</script>
		
	<script>
	$(document).ready(function()
	{
		$(document).keyup(function( event ) {
			if ( event.which==27) {
			  window.location = "newmenu.php";
		  }
		});
	 });
</script>

<script>
$(document).ready(function(){
 
 $('#country').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"fetchProduct.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
	
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
	  
   })
  }

 });
 
   $( function() {
    $( "#o_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  
});
</script>
     
</head>

<body onkeydown="keyCode(event)">
<?php
	include('sidebarHeader.php');
?>
<form method="post" name="f1" id="f1">
<div id="main" style="margin-left:200px">
	
<div class="w3-container w3-display-container">
	<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	<div class="modal-content" style="margin-top:50px;">
        <div class="modal-header">
		<?php
		unset($_SESSION['ses_invoice_id_rt']);
		?>
         <p style="color:#000; font-weight:bold;font-size:17px;">Order Info</p>
        <div class="row">
			<div class="col-sm-3"
			 <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Customer Name</b>
				 <input type="text" name="custName" id="custName" class="form-control" autofocus autocomplete="off" placeholder="Customer Name" tabindex="1" required />
			
			</div>
			<div class="col-sm-3" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Plan_name</b>
				 <input type="text" name="plan_name" id="plan_name" class="form-control" autocomplete="off" placeholder="plan_name" tabindex="2" required />
			
			</div>
			<div class="col-sm-2" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>qty</b>
				 <input type="text" name="qty" id="qty" class="form-control" autocomplete="off" placeholder="Quantity" tabindex="3" />
			
			</div>
			<div class="col-sm-2" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>plan_rate</b>
				 <input type="text" name="plan_rate" id="plan_rate" class="form-control" autocomplete="off" placeholder="plan_rate" tabindex="3" />
			
			</div>
			<div class="col-sm-2">
				<div class="input-group" <?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
					  <b>Order Date</b>
				<input type="text" class="form-control " data-field="date" id="o_date" name="o_date" placeholder="Date" tabindex="4" <?php if($_SESSION['ses_invoice_id_rt']!="")
									{
											?>style="display:none;"<?php
									} ?>  />
			</div>
			</div>
			<div class="col-sm-2"<?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
							<b>Order Time</b>
							<div class="input-group bootstrap-timepicker timepicker">
                <input id="txtTime" name="txtTime" type="text" class="form-control" tabindex="5">
                <span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>
            </div>
		
            <script type="text/javascript">
                $('#txtTime').timepicker();
				            /*$('#txtTime').timepicker({
                minuteStep: 1,
                template: 'modal',
                appendWidgetTo: 'body',
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });*/
            </script>
			</div>
			<div class="col-sm-2"<?php if($_SESSION['ses_invoice_id_rt']!="")
							{
									?>style="display:none;"<?php
							} ?>>
							<br>
							
							
				<button type="submit" class="btn btn-success pull-left" id="btnAdd" name="btnAdd" value="Add" tabindex="6" > <span class="badge"><span class="glyphicon glyphicon-ok"></span></span> Add order</button>
		
			</div>
		</div>
	</div>
	</div>
		
		<?php
	if(isset($_POST['btnAdd']))
	{
		$c_name=$_POST['custName'];
		$pname=$_POST['plan_name'];
		$qty=$_POST['qty'];
		$prate=$_POST['plan_rate'];
		$orddate=date('Y-m-d',strtotime($_POST['o_date']));
		$i=mysql_query("insert into order_info (cust_name,Plan_name,qty,plan_rate,order_date) values ('$c_name','$pname','$qty','$prate','$orddate')");
		if($i>0)
		{
			echo "Success";
			//header('location:order_info.php');
			echo "<script>window.location='order_info.php'</script>";
		}
		else
		{
			echo "Fail";
		}
	}
  ?>
  
	
<div class="modal-body" style="padding:10px 10px;">
		
			</br>
						<div class="scrollable">
						<table class="table table-fixed table-bordered">
							<thead>
							<tr>
								<th>cust_name</th>
								<th>Plan_name</th>
								<th>Quantity</th>
								<th>plan_rate</th>
								<th>order_date</th>
								<th><center>Delete</center></th>
							</tr>
							</thead>
							<?php
		$result=mysql_query("select * from order_info");
		while($row=mysql_fetch_array($result))
		{
			?>
		<tr>
			<td><?php echo $row[1];?></td>
			<td><?php echo $row[2];?></td>
			<td><?php echo $row[3];?></td>
			<td><?php echo $row[4];?></td>
			<td><?php echo $row[5];?></td>
			<td><a href="?id=<?php echo $row[0];?>" onclick="return confirm('Are You Sure ? ');"><span class="glyphicon glyphicon-trash" style="color:red;"></span></a> - <a href="update1.php?id=<?php echo $row[0];?>" ><span class="glyphicon glyphicon-pencil" style="color:blue;"></span></a></td>
		</tr>
		<?php
		}
	?>
		</form>
	</table>
	<?php 
	if(isset($_REQUEST['id']))
	{
		mysql_query("delete  from order_info where order_id='".$_REQUEST['id']."'");
		//header('location:order_info.php');
		echo "<script>window.location='order_info.php'</script>";
	}
	?>