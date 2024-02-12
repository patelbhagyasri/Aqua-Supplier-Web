<?php
	include_once('connection.php');
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
$curDate= date('Y-m-d');

if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
?>

<div class="col-sm-12">
				<?php
				//header("refresh:5,url=DailyReport.php");
				 mysql_query("set names utf8");
					$result=mysql_query("select * from customer_master where truck_id='".$_POST['truckid']."'");
					while($row=mysql_fetch_array($result))
					{
					$flag=0;
					$str='';
						$reschk=mysql_query("select customer_id from water_supply_master where supplied_qty>0 and supply_date='$curDate' AND customer_id='$row[0]'");
						while($r=mysql_fetch_array($reschk))
						{
							if($r[0]==$row[0])
							{
								$flag=1;
							}
							else
							{
								$flag=0;
							}
						}
				
						?>
						
							<div class="col-sm-1 well text-center hover" id="<?php echo $row[0]; ?>" <?php if($flag==1){echo "style='background:#00E676;'";} else{echo "style='background:#F50057;'";}?>><b><?php echo $row[7]; ?></b></div>
						
						<?php
					}
				?>	
			</div>
			<script>
$(document).ready(function(){
	$('.hover').tooltip({
		title:fetchData,
		html:true,
		placement: "bottom"
	});
	function fetchData()
	{
		var fetch_data = '';
		var element = $(this);
		var id = element.attr("id");
		$.ajax({
			url:"fetchTooltip.php",
			method:"POST",
			async:false,
			data:{id:id},
			success:function(data)
			{
				fetch_data = data;
			}
		});
		return fetch_data;
	}
});
</script>