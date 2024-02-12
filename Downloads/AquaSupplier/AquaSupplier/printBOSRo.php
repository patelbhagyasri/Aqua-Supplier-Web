 
<?php
include_once('connection.php');
date_default_timezone_set("Asia/Calcutta");
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
$customerID=$_REQUEST["custID"];

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    
	<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
	<script src="js/jquery.min.js"></script>
 <script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		.td_space{	
			
			padding-left:5px;
			
		}
		.td_space_right{	
			
			padding-right:10px;
			
		}
		.td_space_left{	
			
			padding-left:10px;
			
		}
		.right_border
		{
			border-color:black;
			border-width:1px;
			border-right-style: solid;
			
		}
		.bottom_border
		{
			border-color:black;
			border-width:1px;
			border-bottom-style: solid;
			
		}
		
		    @media print {
			a[href]:after 
			{
				content: none !important;
			}
		}
		.notice{
		font-size:10px;
		}
	#tmo{
	color:red;
	}
	table{
		border-collapse:collapse;
	}
		</style>


<script>
function myFunction() {
    window.print();
}
</script>
</head>

<body style="font-family: Arial, Helvetica, sans-serif;font-size:11px;">

<div style="float:right"><b>Original / Duplicate / Triplicate</b></div>
<table border="0" align="" width="100%">
<tr><td style="padding-right:10px;">

<table border="0" align="" width="100%">
<?php
		mysql_query('set names utf8');
		$result=mysql_query("select * from customer_master where customer_id='$customerID'");
		while($row=mysql_fetch_array($result))
		{
				$name=$row['customer_name'];		
				$address=$row['customer_address'];
				$contact=$row['customer_contact'];
				$houseNo=$row['house_no'];
				
		}

?>
	<tr>
		<td  align="center">
			<table border="1" width="100%">
				
				<tr>
				<td colspan="2">
			
					<center>	
						
						
						<b style="font-size:20px;"> 
					THE AQUA SUPPLIER</b>
					 <b style="font-size:15px;"> <br>
				SHOP NO:12,MUDIT PLACE,STATION ROAD,BARDOLI
				<br>
					PHONE NO:7405238714

					
					 </b>
						
					</center>
				</td>
				
				</tr>
				
				
				
				
				<tr>
					
					<td  align="left">
						
						<table border="0">
							
							<tr>
								<td class="td_space"><br><b style="font-size:15px;"> NAME: <?php echo $name; ?></b></td>
								
							</tr>
							
							<tr>
								<td class="td_space"><b>ADDRESS : <?php echo $address; ?></b></td>
							
								
							</tr>
							
						</table>
						
						
						 
					</td>
					<td align="left">
						<table border="0">
							
							<tr>
							</br>
								<td class="td_space"><b style="font-size:15px;border-radius:0px;border: 2px solid #000000;padding:2px;"> <?php echo $houseNo; ?></b></td>
							</tr>
							<tr>
								<td class="td_space"><br><b style="font-size:13px;"><?php echo date('F-Y',strtotime($_REQUEST['monthYear'])); ?></td>
								<td></td>
							</tr>
							
							<tr>
								
							</tr>
							
							
						</table>
					</td>
				</tr>
				
				
				<tr>
		<td colspan="2">
			<table border="0" width="100%">
			<thead>
				<tr style="background-color:#808080;color:#fff;">
					<th class="right_border"><center>NO</center></th>
					<th class="right_border"><center>PARTICULAR</center></th>
					<th class="right_border"><center>NOS</center></th>	
					<th class="right_border"><center>PRICE</center></th>
					<th class=""><center> TOTAL RS.</center></th>
				</tr>
				</thead>
					<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				
				<?php
					$billtype=$_SESSION['invoice_type'];
					$count=1;
					$totalvat=0;
							$totalvat2=0;
							$totalvalue=0;
							 $starDate=date('Y-m-d',strtotime($_REQUEST['monthYear']));
							//echo $endDate=date('Y-m-d',strtotime('29-'.$_REQUEST['monthYear']));
							$totalAmt=0;
							$totalDeposit=0;
							$result1=mysql_query("select plan_name,sum(supplied_qty),sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='$customerID' and MONTH(supply_date)=MONTH('$starDate') GROUP BY plan_name");
					while($row1=mysql_fetch_array($result1))
						{
							
							$totalAmt=$totalAmt+$row1[2];
							$totalDeposit=$totalDeposit+$row1[3];
				?>
							<tr>
							<td class="right_border"><center><?php echo $count; ?></center></td>
							<td class="right_border"><?php echo $row1[0]; ?></td>
							
						
							<td class="right_border"><center><?php echo $row1[1]?></center></td>
							<td class="right_border"><center><?php echo $row1[2]/$row1[1]; ?></center></td>
							<td><center><?php echo $row1[2];?></center></td>
						
							
						
							</tr>
				<?php	
							$count++;
							
							
						}
?>
			</tr>
			
			<?php
			
			
							$rr=mysql_query("select count(*) from temp_invoice where invoice_id='$billno'");
							while($r=mysql_fetch_array($rr))
							{
								$totalrow=$r[0];
							}
							$emptyrow=4-$totalrow;
						for($i1=0;$i1<=$emptyrow;$i1++){
							
							?>
									<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
							<td class="right_border"><center>&nbsp;</center></td>
							<td class=""><center>&nbsp;</center></td>
							
							</tr>
							<?php
							}
							?>
							
							
							<?php
							$resSum=mysql_query("select sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='$customerID'");
					while($rowSum=mysql_fetch_array($resSum))
						{
							$totalDue=$rowSum[0]-$rowSum[1];
						}
						?>
			
				<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<tfoot>
				<tr style="background-color:#808080;color:#fff;">
					
					<td ><center>&nbsp;</center></td>
					<td><center>&nbsp;&nbsp;<b> </b></center></td>
					
							
					
					<td class="right_border"><center>&nbsp;<b></center></td>
			
					<td><center class="right_border">TOTAL </center></td>
					<td class=""><center><b><?php echo $totalAmt; ?></b></center></td>

					
				
					
				
					
					
				</tr>
				
				<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						<?php
							$rrr=mysql_query("select sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='$customerID' and MONTH(supply_date)!=MONTH('$starDate') GROUP BY plan_name");
							$olddue="";
							while($fetchRow=mysql_fetch_array($rrr))
							{
								$olddue=$fetchRow[0]-$fetchRow[1];
							}
						?>	<td class="right_border"><center>&nbsp;OLD DUE </center></td>
							<td class=""><center>&nbsp;<?php //ho $olddue; ?></center></td>
							
							</tr>
							
							<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<!--
			<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
					 class="right_border"><center>&nbsp;DEPOSIT</center></td>
							<td class=""><center>&nbsp;<?php//cho $totalDeposit; ?></center></td>
							
							</tr> 
							
							<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>  -->
						
							<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
							<td class="right_border"><center>&nbsp;Total Due </center></td>
							<td class=""><center>&nbsp;<?php //echo //$totalDue; ?></center></td>
							
							</tr>
								<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<tr>
				
					<tr>
						<td colspan="10">
								<table border="0" width="100%">
									<tr>
										<td class="">
											<div class="notice">
												
											
											<br>
											<br>
				
				
											
											 AQUA SUPPLIER
											</div>
										</td>
										
										<td class="td_space_left" align="center">
										
											
											<br>
											<br>
				
				
											
										SIGN
										</td>
										
									</tr>
								</table>
						
						</td>
						
					</tr>
				</tr>
				
				</tfoot>
				
			</table>
		</td>
	</tr>
			</table>
		</td>
		
	</tr>
	
</table>
</td>
<td style="padding-right:10px;">

<table border="0" align="" width="100%">
<?php
		mysql_query('set names utf8');
		$result=mysql_query("select * from customer_master where customer_id='$customerID'");
		while($row=mysql_fetch_array($result))
		{
				$name=$row['customer_name'];		
				$address=$row['customer_address'];
				$contact=$row['customer_contact'];
				$houseNo=$row['house_no'];
				
		}

?>
	<tr>
		<td  align="center">
			<table border="1" width="100%">
				
				<tr>
				<td colspan="2">
			
					<center>	
						
						
						<b style="font-size:20px;"> 
					THE AQUA SUPPLIER</b>
					 <b style="font-size:15px;"> <br>
				SHOP NO:12,MUDIT PLACE,STATION ROAD,BARDOLI
				<br>
					PHONE NO:7405238714

					
					 </b>
						
					</center>
				</td>
				
				</tr>
				
				
				
				
				<tr>
					
					<td  align="left">
						
						<table border="0">
							
							<tr>
								<td class="td_space"><br><b style="font-size:15px;"> NAME: <?php echo $name; ?></b></td>
								
							</tr>
							
							<tr>
								<td class="td_space"><b>ADDRESS : <?php echo $address; ?></b></td>
							
								
							</tr>
							
						</table>
						
						
						 
					</td>
					<td align="left">
						<table border="0">
							
							<tr>
							</br>
								<td class="td_space"><b style="font-size:15px;border-radius:0px;border: 2px solid #000000;padding:2px;"> <?php echo $houseNo; ?></b></td>
							</tr>
							<tr>
								<td class="td_space"><br><b style="font-size:13px;"><?php echo date('F-Y',strtotime($_REQUEST['monthYear'])); ?></td>
								<td></td>
							</tr>
							
							<tr>
								
							</tr>
							
							
						</table>
					</td>
				</tr>
				
				
				<tr>
		<td colspan="2">
			<table border="0" width="100%">
			<thead>
				<tr style="background-color:#808080;color:#fff;">
					<th class="right_border"><center>NO</center></th>
					<th class="right_border"><center>PARTICULAR</center></th>
					<th class="right_border"><center>NOS</center></th>	
					<th class="right_border"><center>PRICE</center></th>
					<th class=""><center> TOTAL RS.</center></th>
				</tr>
				</thead>
					<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				
				<?php
					$billtype=$_SESSION['invoice_type'];
					$count=1;
					$totalvat=0;
							$totalvat2=0;
							$totalvalue=0;
							 $starDate=date('Y-m-d',strtotime($_REQUEST['monthYear']));
							//echo $endDate=date('Y-m-d',strtotime('29-'.$_REQUEST['monthYear']));
							$totalAmt=0;
							$totalDeposit=0;
							$result1=mysql_query("select plan_name,sum(supplied_qty),sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='$customerID' and MONTH(supply_date)=MONTH('$starDate') GROUP BY plan_name");
					while($row1=mysql_fetch_array($result1))
						{
							
							$totalAmt=$totalAmt+$row1[2];
							$totalDeposit=$totalDeposit+$row1[3];
				?>
							<tr>
							<td class="right_border"><center><?php echo $count; ?></center></td>
							<td class="right_border"><?php echo $row1[0]; ?></td>
							
						
							<td class="right_border"><center><?php echo $row1[1]?></center></td>
							<td class="right_border"><center><?php echo $row1[2]/$row1[1]; ?></center></td>
							<td><center><?php echo $row1[2];?></center></td>
						
							
						
							</tr>
				<?php	
							$count++;
							
							
						}
?>
			</tr>
			
			<?php
			
			
							$rr=mysql_query("select count(*) from temp_invoice where invoice_id='$billno'");
							while($r=mysql_fetch_array($rr))
							{
								$totalrow=$r[0];
							}
							$emptyrow=4-$totalrow;
						for($i1=0;$i1<=$emptyrow;$i1++){
							
							?>
									<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
							<td class="right_border"><center>&nbsp;</center></td>
							<td class=""><center>&nbsp;</center></td>
							
							</tr>
							<?php
							}
							?>
							
							
							<?php
							$resSum=mysql_query("select sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='$customerID'");
					while($rowSum=mysql_fetch_array($resSum))
						{
							$totalDue=$rowSum[0]-$rowSum[1];
						}
						?>
			
				<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<tfoot>
				<tr style="background-color:#808080;color:#fff;">
					
					<td ><center>&nbsp;</center></td>
					<td><center>&nbsp;&nbsp;<b> </b></center></td>
					
							
					
					<td class="right_border"><center>&nbsp;<b></center></td>
			
					<td><center class="right_border">TOTAL </center></td>
					<td class=""><center><b><?php echo $totalAmt; ?></b></center></td>

					
				
					
				
					
					
				</tr>
				
				<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						<?php
							$rrr=mysql_query("select sum(plan_rate),sum(deposit_amount) from water_supply_master where customer_id='$customerID' and MONTH(supply_date)!=MONTH('$starDate') GROUP BY plan_name");
							$olddue="";
							while($fetchRow=mysql_fetch_array($rrr))
							{
								$olddue=$fetchRow[0]-$fetchRow[1];
							}
						?>	<td class="right_border"><center>&nbsp;OLD DUE </center></td>
							<td class=""><center>&nbsp;<?php //ho $olddue; ?></center></td>
							
							</tr>
							
							<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<!--
			<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
					 class="right_border"><center>&nbsp;DEPOSIT</center></td>
							<td class=""><center>&nbsp;<?php//cho $totalDeposit; ?></center></td>
							
							</tr> 
							
							<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>  -->
						
							<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
							<td class="right_border"><center>&nbsp;Total Due </center></td>
							<td class=""><center>&nbsp;<?php //echo //$totalDue; ?></center></td>
							
							</tr>
								<tr>
					<td colspan="5" class="bottom_border">
						
					</td>
				</tr>
				<tr>
				
					<tr>
						<td colspan="10">
								<table border="0" width="100%">
									<tr>
										<td class="">
											<div class="notice">
												
											
											<br>
											<br>
				
				
											
											 AQUA SUPPLIER
											</div>
										</td>
										
										<td class="td_space_left" align="center">
										
											
											<br>
											<br>
				
				
											
										SIGN
										</td>
										
									</tr>
								</table>
						
						</td>
						
					</tr>
				</tr>
				
				</tfoot>
				
			</table>
		</td>
	</tr>
			</table>
		</td>
		
	</tr>
	
</table>
</td>
<!--<form name="back" method="post" >
<input type="submit" name="btnback" value="Back"/>
<?php
/*if(isset($_POST['btnback'])){
	header('Location:Home.php');
	session_destroy();
}*/
			
								unset($_SESSION['ses_invoice_id_rt']);
									unset($_SESSION['ses_edit_invoice_date']);
									unset($_SESSION['ses_invoice_type_rt']);
						
	
	unset($_SESSION['ses_product_rate']);
	unset($_SESSION['ses_total_amount']);
	unset($_SESSION['ses_cal_less_amount']);
	unset($_SESSION['ses_max_vat']);
	unset($_SESSION['ses_min_vat']);
	unset($_SESSION['ses_excise_amount']);
	unset($_SESSION['ses_netamt']);
	unset($_SESSION['ses_edit_invoice_id']);
	
?>
</form>-->
</body>
</html>