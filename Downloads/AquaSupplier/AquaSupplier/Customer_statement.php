<?php
include_once('connection.php');
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>

 
	<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
	<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
	<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />

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
		$('#selCom').focus();
		
		         
		
		$( "#selCom").keypress(function( event ) {
		  if ( event.which == 13) {
			 $('#start_date').focus();
			return false;
		  }
		
		});
		$( "#start_date").keypress(function( event ) {
		if ( event.which == 13) {
			 $('#end_date').focus();
			 return false;
		  }
		});
		
		$( "#end_date").keypress(function( event ) {
		if ( event.which == 13) {
			 $('#btnSearch').focus();
			return false;
		  }
		});
	
		$( "#btnSearch").keypress(function( event ) {
		if ( event.which == 13) {
			
			if($('#start_date')=="")
			{
			$('#start_date').focus();
			return false;
			}
			
			if($('#end_date')=="")
			{
			$('#end_date').focus();
			return false;
			}
			
		  }
		});
		
	});
</script>

<script type="text/javascript">

	  
	   $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#purchase_date" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
  
  $(function() {
			//var picdate={dateFormate:"yy-mm-dd"};
			$( "#purchase_date1" ).datepicker(
			//{dateFormat:"yy MM dd  "
			//}
			);
  });
</script>

</head>

<body onkeydown="keyCode(event)">
<form name="insert" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()" enctype="multipart/form-data">
<?php
include('menu.php');
?>

<div class="container">

<div class="row">
	<div class="col-sm-3">
	<input type="text" class="form-control" name="purchase_date" id="purchase_date"  required />
	</div>
	
	<div class="col-sm-3">
	<input type="text" class="form-control" name="purchase_date1" id="purchase_date1"  required />
	</div>
	<div class="col-sm-3">
	<select class="form-control"  name="custname">
		<option value="">-- Customer Name --</option>
	<?php
		$selcust=mysql_query("select * from customer_master");
		while($row=mysql_fetch_array($selcust))
		{
	?>
		<option value="<?php echo $row['cid']; ?>"><?php echo $row['cname']; ?></option>
	<?php
		}
	?>
	</select>
	</div>
	<div class="col-sm-3">
		<input type="submit" class="form-control btn btn-primary" id="btnSearch" name="btnSearch" value="Search">
	</div>
</div>

<div class="row">


<div class="col-sm-12">
<div class="table-responsive">          
  <table class="table table-hover">
    <thead>
      <tr class="danger">
        <th>Inv.No</th>
        <th>Name</th>
		<th>Amt</th>
		<th>Max</th>
		<th>Min</th>
		<th>Inv.Type</th>
		<th>NetAmt</th>
		<th>View</th>
		
      </tr>
    </thead>
       
       <?php  
	   if(isset($_POST['btnSearch']))
	   {
			$d1=strtotime($_POST['purchase_date']);
			$dd1=date('Y-m-d',$d1);
			$d2=strtotime($_POST['purchase_date1']);
			$dd2=date('Y-m-d',$d2);
        	        	$query="select fi.invoice_id,gi.cname,fi.amount,fi.max_vat,fi.min_vat,fi.invoice_type,fi.net_amount from generate_invoice gi , Final_invoice fi where gi.invoice_id = fi.invoice_id AND fi.invoice_date BETWEEN '".$dd1."' AND '".$dd2."' AND gi.cid='".$_POST['custname']."'";
			
			$r=mysql_query($query);
	
			while($row=mysql_fetch_array($r))
			{
				?>
				<tr>
					<td><?php echo $row[0];?></td>
					<td><?php echo $row[1];?></td>
					<td><?php echo $row[2];?></td>
					<td><?php echo $row[3];?></td>
					<td><?php echo $row[4];?></td>
					<td><?php echo $row[5];?></td>
					<td><?php echo $row[6];?></td>
					<td><a href="printbill.php?id=<?php echo $row[0];?>" style="color:blue;"><b>View</b></a></td>
				
		
				</tr>
				<?php
			}
			
			
			
			
			
		
		
			$query1="select sum(fi.net_amount)from final_invoice fi,generate_invoice gi where fi.invoice_id=gi.invoice_id AND fi.invoice_date BETWEEN '".$dd1."' AND '".$dd2."' AND gi.cid='".$_POST['custname']."'";
			
			$result=mysql_query($query1);
			
			while($row2=mysql_fetch_array($result))
			{
				$amt=$row2[0];
				
			}
		
			
			
		}
		
		?>
		
        </table>
	

</div>
</div>

</div>

<div class="row text-center">
	<div class="col-sm-12">
	
		
	
		<button class="btn btn-success"><b> Total Sell = <?php echo $amt; ?> /- </b></button>
	</div>
	
</div>

</div>
</div>

</form>

</form>
</body>
</html>
