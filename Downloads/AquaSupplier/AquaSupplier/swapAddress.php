<?php 
include"dbclass.php";
$db = new db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Address</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	 <link rel="stylesheet" href="bootstrap/css/w3.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/jquery-ui.js" type="text/javascript"></script>
<script src="bootstrap/js/jquery-ui.min.js" type="text/javascript"></script>
<link href="bootstrap/css/jquery-ui.css" rel="stylesheet" type="text/css" />

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
  $(function() {
	$( ".row_position" ).sortable({
		delay: 150,
		change: function() {
	var selectedLanguage = new Array();
	$('.row_position>tr').each(function() {
	selectedLanguage.push($(this).attr("id"));
	});
	document.getElementById("row_order").value = selectedLanguage;
	}
	});
  });
  
  function save() { 
	var data = new Array();
	$('.row_position tr').each(function() {
	   data.push($(this).attr("id"));
	});
	
	$.ajax({
		url:"ajax.php",
		type:'post',
		data:{position:data},
		success:function(){
			alert('your change successfully saved');
		}
	})
  }
  </script>
  <style>
  .row_position{
  cursor:move
  }
  </style>
  
</head>
<body style="background:#e6e6e6;color:black;">
<?php
	include('sidebarHeader.php');
?>
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
	
	<div class="container-fluid" style="margin-top:10px;">
			<span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
			<div class="modal-content" style="margin-top:50px;">
				<div class="modal-header">
					 <p style="color:#000; font-weight:bold;font-size:17px;">Swap Address</p>
					 
				</div>
				<div class="modal-body" style="padding:10px 10px;">
				<table class="table table-bordered" style="font-size:12px; font-weight:bold;">
						<thead>
						  <tr>
							<th>SN</th>
							<th>Name</th>
							<th>Address</th>
							<th>Card No</th>
						  </tr>
						</thead>
						<tbody class="row_position" >
						<?php 
						$truckID=$_REQUEST['truckID'];
						$result = array(); 
						
						 $data_lists = $db->select('customer_master',"where truck_id='$truckID' order by position_order asc");
						 foreach($data_lists as $data_list){
						// array_push($result,
					//array('position_id'=>$data_list[0],'title'=>$data_list[1],'desc'=>$data_list[2],'posOrder'=>$data_list[3],'car'=>$data_list[5]));
						?>
						
						  <tr id="<?php echo $data_list['customer_id']; ?>" >
							<td  ><?php echo $data_list['customer_id']; ?></td>
							<td><?php echo $data_list['customer_name']; ?></td>
							<td><?php echo $data_list['customer_address']; ?></td>
							<td><?php echo $data_list['house_no']; ?></td>
						  </tr>
						 <?php }
					//echo json_encode(array("result"=>$result));
						 ?>
						</tbody>
					  </table>
					  <div style="text-align:center;" >  
					<input type="submit" class="btn btn-primary"  value="Save Data"  onClick="save();" />
					</div>
				</div>
			</div>
		</div>
	
</div>
</div>

</body>
</html>
