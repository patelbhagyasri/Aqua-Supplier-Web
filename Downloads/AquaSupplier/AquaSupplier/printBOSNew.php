
<?php
include_once('connection.php');
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
$clientID=$_REQUEST['custID'];

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

<!--<div style="float:right"><b>Original / Duplicate / Triplicate</b></div>-->
<table border="0" align="" width="100%">
<?php
		mysql_query("set names utf8");
		$result=mysql_query("select * from customer_master where customer_id='$clientID'");
		while($row=mysql_fetch_array($result))
		{
				$name=$row[1];		
				$address=$row[3];
				$contact=$row[2];
				$due_date=date('d-m-Y');
				
		}

?>
	<tr>
		<td  align="center">
			<table border="1" width="100%">
				
				<tr>
					
					<td  align="left">
						
						<table border="0">
							
							<tr>
								<td class="td_space"><b style="font-size:15px;"><?php echo $name; ?></b></td>
								
							</tr>
							
							<tr>
								<td class="td_space"><b><?php echo $address; ?></b></td>
								
							</tr>
							<tr>
								<td class="td_space"><b><?php if(strlen($gstno)==15){ echo "GSTIN :";}
																if(strlen($gstno)==12){ echo "ADHAR :";}
																if(strlen($gstno)==10){ echo "PAN :";}
								?> <?php echo $gstno; ?> </b></td>
								
							</tr>
						</table>
						
						
						 
					</td>
					<td align="left">
						<table border="0">
							
							<tr>
								<td class="td_space"><b>Invoice Date : </b><b style="font-size:15px;"> <?php echo date('d-M-Y'); ?></b></td>
								<td></td>
							</tr>
							<tr>
								<td class="td_space"><b>Month : </b><b style="font-size:15px;"> <?php echo date('M-Y',strtotime('1-'.$_REQUEST['monthYear'])); ?></b></td>
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
					<th class="right_border"><center>#</center></th>
					<th class="right_border"><center>Name Of Plan</center></th>
					<th class="right_border"><center>Supply Qty</center></th>	
					<th class="right_border"><center>Return Qty</center></th>
					<th class=""><center>Debit Amt</center></th>
					<th class=""><center>Amount</center></th>
				</tr>
				</thead>
					<tr>
					<td colspan="6" class="bottom_border">
						
					</td>
				</tr>
				
				<?php
					$billtype=$_SESSION['invoice_type'];
					$count=1;
					$totalvat=0;
							$totalvat2=0;
							$totalvalue=0;
							$month=date('Y-m');
							
							mysql_query("set names utf8");
							$NetAmount="0";
							$NetDeposite="0";
							$NetSupplyQty="0";
							$NetReturnQty="0";
							for($i=1;$i<32;$i++)
							{
								$planName="-";
								$suppliedQty="-";
								$returnQty="-";
								$planRate="-";
								$depositAmount="-";
								$supplyDate=date('Y-m-d',strtotime($i.'-'.$_REQUEST['monthYear']));
								
								$resWSM=mysql_query("select * from water_supply_master where supply_date='$supplyDate' and customer_id='$clientID'");
								while($rowWSM=mysql_fetch_array($resWSM))
								{
									$planName=$rowWSM['plan_name'];
									$suppliedQty=$rowWSM['supplied_qty'];
									$returnQty=$rowWSM['return_qty'];
									$planRate=$rowWSM['plan_rate'];
									$depositAmount=$rowWSM['deposit_amount'];
								}
								$NetAmount=$NetAmount+$planRate;
								$NetDeposite=$NetDeposite+$depositAmount;
								$NetSupplyQty=$NetSupplyQty+$suppliedQty;
								$NetReturnQty=$NetReturnQty+$returnQty;
								?>
							<tr >
							<td class="right_border"><center><?php echo $supplyDate ?></center></td>
							
							<td class="right_border"><b><?php echo $planName;?></b></td>
							<td class="right_border"><center><?php echo $suppliedQty;?></center></td>
							<td class="right_border"><center><?php echo $returnQty; ?></center></td>
							<td class="right_border"><center><?php echo $depositAmount;?></center></td>
							<td class="right_border"><center><?php echo $planRate;?></center></td>
							</tr>
					<?php	
							}
							
					
							$count++;
							
							$totalvat=$totalvat+$totvat;
							$totalvat2=$totalvat2+$totvat2;
							$totalvalue=$totalvalue+$tot;
						
?>
			</tr>
			
			<?php
							$rr=mysql_query("select count(*) from water_supply where customer_id='$billno'");
							while($r=mysql_fetch_array($rr))
							{
								$totalrow=$r[0];
							}
							
						
							?>
			
				<tr>
					<td colspan="6" class="bottom_border">
						
					</td>
				</tr>
				<tfoot>
				<tr style="background-color:#808080;color:#fff;">
					
					<td ><center>&nbsp;</center></td>
					<td><center>&nbsp;<b>Total</b></center></td>
					
						
					
					<td class="right_border"><center>&nbsp;<b><?php echo  $NetSupplyQty;?></center></td>
			
					<td><center class="right_border"><?php echo $NetSupplyQty; ?></b></center></td>
					<td class="right_border"><center>&nbsp;<b><?php echo $NetDeposite; ?></b></center></td>
					<td class="right_border"><center>&nbsp;<b><?php echo $NetAmount; ?></b></center></td>

					
				
					
				
					
					
				</tr>
				
				<tr>
					<td colspan="6" class="bottom_border">
						
					</td>
				</tr>
				<tr>
				
				<td colspan="4"  class="td_space_left">
					
						<table width="100%">
							<tr>
								<td class="right_border" align="center">
									
									
									 Total Invoice Amount in Words : 
									<?php
									
							
								
							$number =$NetAmount-$NetDeposite;
							
							
							
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) 
   {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number)
		 {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  //$points = ($point) ?"." . $words[$point / 10] . " " .$words[$point = $point % 10] : '';
  $result;
 
 ?>
<b><?php  echo $result;?>Rupees Only</b> 


								</td>
								
							</tr>
						</table>
					
					</td>
					<td colspan="5">
					
						<table width="100%">
							<tr>
								<td class="right_border" align="left">
							Total Amount 
									
								</td>
								<td class="td_space_left"><b><?php echo $NetAmount-$NetDeposite;?></b></td>
								
							</tr>
						
						</table>
					
					</td>
					<tr>
					<td colspan="6" class="bottom_border">
						
					</td>
				</tr>
					
					<tr>
						<td colspan="10">
								<table border="0" width="100%">
									<tr>
										<td class="right_border">
											<div class="notice">
												
												<b> E.&.O.E. </b>
											</div>
										</td>
										<!--<td class="right_border" align="center">
											<div class="notice">
											
											</div>
										</td>-->
										<td class="td_space_left" align="center">
										<b>
											<?php
											$resDue=mysql_query("SELECT sum(plan_rate),sum(deposit_amount) FROM water_supply_master WHERE customer_id='$clientID'");
											while($rowDue=mysql_fetch_array($resDue))
												{
													$totalRate=$rowDue[0];
													$totalDeposite=$rowDue[1];
													$totalDue=($totalRate-$totalDeposite);
												}
										?>
											
											Total Bal Rs.  <?php echo $totalDue;?> Dr.
										</b>
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

</body>
</html>