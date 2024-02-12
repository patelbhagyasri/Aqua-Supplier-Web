
<?php
include_once('connection.php');
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
$invoiceID=$_REQUEST["invoiceID"];

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
</script
</head>

<body style="font-family: Arial, Helvetica, sans-serif;font-size:11px;">

<div style="float:right"><b>Original / Duplicate / Triplicate</b></div>
<table border="0" align="" width="100%">
<?php
		mysql_query('set names utf8');
		$result=mysql_query("select * from generate_invoice where invoice_id='$invoiceID'");
		while($row=mysql_fetch_array($result))
		{
				$name=$row['cname'];		
				$address=$row['address1'];
				$contact=$row['ccontact'];
				$orderDate=$row['order_date'];
				$invoiceDate=$row['invoice_date'];
				
		}

?>
	<tr>
		<td  align="center">
			<table border="1" width="100%">
				
				<tr>
				<td colspan="2">
			
						
						
						
						<center> <b style="font-size:50px;"> 
					अमृत जल<br></b>
					 <b style="font-size:15px;"> 
					रेलवे स्टेशन सामने</br>
					नवापुर</br>
					मो. नं . ७०४६१५६७८९
					
					 </b></center>
						
					
				</td>
				
				</tr>
				
				
				
				
				<tr>
					
					<td  align="left">
						
						<table border="0">
							
							<tr>
								<td class="td_space"><b style="font-size:15px;">नाव: <?php echo $name; ?></b></td>
								
							</tr>
							
							<tr>
								<td class="td_space"><b>पत्ता : <?php echo $address; ?></b></td>
								<td class="td_space"></td>
								
							</tr>
							
						</table>
						
						
						 
					</td>
					<td align="left">
						<table border="0">
							
							<tr>
								<td class="td_space"><b style="font-size:15px;">order Date :<?php echo date('d-M-Y',strtotime($orderDate)); ?></b></td>
							</tr>
							<tr>
								<td class="td_space"><b>बील दिनांक  : </b><b style="font-size:15px;"> <?php echo date('d-M-Y',strtotime($invoiceDate)); ?></b></td>
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
					
					<th class="right_border"><center>नं</center></th>
					<!--<th class="right_border"><center>तपशिल</center></th>-->
					<th class="right_border"><center>Supplied QTY</center></th>
					<th class="right_border"><center>Return QTY</center></th>
					<th class="right_border"><center>Supply नंग</center></th>	
					<th class="right_border"><center>Return नंग</center></th>	
					<th class="right_border"><center>Remaining नंग</center></th>	
					<th class="right_border"><center>भाव</center></th>
					<th class=""><center>रुपये</center></th>
				</tr>
				</thead>
					<tr>
					<td colspan="8" class="bottom_border">
						
					</td>
				</tr>
				
				<?php
					
					$count=1;
					$totalvat=0;
							$totalvat2=0;
							$totalvalue=0;
							 $starDate=date('Y-m-d',strtotime($_REQUEST['monthYear']));
							//echo $endDate=date('Y-m-d',strtotime('29-'.$_REQUEST['monthYear']));
					$resTempSupplied=mysql_query("select product_name,sum(product_qty),sum(amount) from temp_invoice where invoice_id='$invoiceID' group by product_name");
					while($rowTempSupplied=mysql_fetch_array($resTempSupplied))
					{
							mysql_query('set names utf8');
							$resTempReturn=mysql_query("select product_name,sum(product_qty) from temp_invoice_return where invoice_id='$invoiceID' and product_name='$rowTempSupplied[0]'");
							$rowTempSupplied[0];
							while($rowTempReturn=mysql_fetch_array($resTempReturn))
							{
								$returnQty=$rowTempReturn[1];
							}
							
							
							
							
									  							
							?>
							<tr>
									
							<td class="right_border"><center><?php echo $count++; ?></center></td>
						
							
						
									<td class="right_border"><center><?php 
									mysql_query('set names utf8');
							$resSuppliedTime=mysql_query("select orderTime,product_qty,product_rate,amount,product_name from temp_invoice where invoice_id='$invoiceID' and product_name='$rowTempSupplied[0]'");
							while($rowSuppliedTime=mysql_fetch_array($resSuppliedTime))
							{
								echo "<b>".$rowSuppliedTime[4]."</b> ".date('d-M-Y h:i A',strtotime($rowSuppliedTime[0]))." : <b>".$rowSuppliedTime[1]."</b><br>";
								
								
							}
							echo "<br>";
									?></center></td>
									<td class="right_border"><center><?php 
									mysql_query('set names utf8');
							$totalRQty="";
							$resReturnTime=mysql_query("select returnTime,product_qty from temp_invoice_return where invoice_id='$invoiceID' and product_name='$rowTempSupplied[0]'");
						
							while($rowRetrunTime=mysql_fetch_array($resReturnTime))
							{
								
							echo date('d-M-Y h:i A',strtotime($rowRetrunTime[0]))." : <b>".$rowRetrunTime[1]."</b><br>";
							$totalRQty=$totalRQty+$rowRetrunTime[1];
							}
									?></center></td>
									<td class="right_border"><center><?php echo $rowTempSupplied[1]?></center></td>
									<td class="right_border"><center><?php echo $totalRQty?></center></td>
									<td class="right_border"><center><?php echo $rowTempSupplied[1]-$totalRQty?></center></td>
									<td class="right_border"><center><?php echo $rowTempSupplied[2]/$rowTempSupplied[1]; ?></center></td>
									<td class="right_border"><center><?php echo $rowTempSupplied[2];?></center></td>
						
							
						
							</tr>
								<?php				
							
					}
						
?>
			</tr>
			
			<?php
			
			
							$rr=mysql_query("select count(*) from temp_invoice where invoice_id='$invoiceID'");
							while($r=mysql_fetch_array($rr))
							{
								$totalrow=$r[0];
							}
							$emptyrow=14-$totalrow;
						for($i1=0;$i1<=$emptyrow;$i1++){
							
							?>
									<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
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
							$resSum=mysql_query("select sum(amount) from temp_invoice where invoice_id='$invoiceID'");
					while($rowSum=mysql_fetch_array($resSum))
						{
							$totalSum=$rowSum[0];
						}
						?>
			
				<tr>
					<td colspan="8" class="bottom_border">
						
					</td>
				</tr>
				<tfoot>
				<tr style="background-color:#808080;color:#fff;">
					
					<td ><center>&nbsp;</center></td>
					
					
							
					
					<td class="right_border"><center>&nbsp;<b></center></td>
					<td class="right_border"><center>&nbsp;<b></center></td>
					<td class="right_border"><center>&nbsp;<b></center></td>
					<td class="right_border"><center>&nbsp;<b></center></td>
					<td class="right_border"><center>&nbsp;<b></center></td>
			
					<td><center class="right_border">Total</center></td>
					<td class=""><center><b><?php echo $totalSum; ?></b></center></td>

					
				
					
				
					
					
				</tr>
				
				<?php
							$rrr=mysql_query("select sum(amount),sum(debit) from statement where invoice_id='$invoiceID'");
							
							while($fetchRow=mysql_fetch_array($rrr))
							{
								$totalDue=$fetchRow[0]-$fetchRow[1];
							}
						?>
							
							<tr>
					<td colspan="8" class="bottom_border">
						
					</td>
				</tr>
					<?php
							$resDeposite=mysql_query("select sum(debit) from statement where invoice_id='$invoiceID' and remark='Deposite' and status='Paid'");
							
							while($rowDeposite=mysql_fetch_array($resDeposite))
							{
								$totalDeposite=$rowDeposite[0];
							}
						?>
				<tr >
							
							<td class="right_border"><center>&nbsp;</center></td>
							
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
							<td class="right_border"><center>&nbsp;जमा  ( deposite):</center></td>
							<td class=""><center>&nbsp;<?php echo $totalDeposite; ?></center></td>
							
							</tr>
							
							<tr>
					<td colspan="8" class="bottom_border">
						
					</td>
				</tr>
						
							<tr >
							<td class="right_border"><center>&nbsp;</center></td>
							
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
							<td class="right_border"><center>&nbsp;</center></td>
						
							<td class="right_border"><center>&nbsp;Total Due </center></td>
							<td class=""><center>&nbsp;<?php echo $totalDue; ?></center></td>
							
							</tr>
								<tr>
					<td colspan="8" class="bottom_border">
						
					</td>
				</tr>
				<tr>
				
			
					
					
					<tr>
						<td colspan="10">
								<table border="0" width="100%">
									<tr>
										<td>
											<div class="notice">
												<b>१ .  कृपया बिल ७ तारीख के अंदर जमा करे . </b></br>
												<b>२.  बिल जमा करते समय कार्ड पर  सही करे और बिल वर पैसे लेनेवाले की सही लीजिए और बिल संभालकर रखे  . </b>
											</div>
										</td>
										

										
									</tr>
								</table>
						
						</td>
						
					</tr>
					<tr>
						<td colspan="10">
								<table border="0" width="100%">
									<tr>
										<td class="">
											<div class="notice">
												
											
											<br>
											<br>
				
				
											
											पैसे लेनेवाले की सही 
											</div>
										</td>
										
										<td class="td_space_left" align="center">
										
											
											<br>
											<br>
				
				
											
										सही
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
<!--<form name="back" method="post" >
<input type="submit" name="btnback" value="Back"/>
<?php
/*if(isset($_POST['btnback'])){
	header('Location:Home.php');
	session_destroy();
}*/
			
	unset($_SESSION['ses_invoice_id_rt']);
	unset($_SESSION['ses_date_order']);
	unset($_SESSION['ses_invoice_date']);						
	unset($_SESSION['ses_invoice_type_rt']);
	
	
?>
</form>-->
</body>
</html>