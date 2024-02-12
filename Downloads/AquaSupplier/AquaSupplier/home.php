 
 <?php
include_once('connection.php');
//echo 'hiii';
if (!isset($_SESSION['name'])) {
	//header('location:index.php');
		echo "<script>window.location='index.php'</script>";	
	}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>


				 <script>
       history.pushState(null, null, document.title);
       window.addEventListener('popstate', function () {
           history.pushState(null, null, document.title);
       });
</script>
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
</head>
<body>

<div style="background:#e6e6e6;color:black;">
<?php
	include('sidebarHeader.php');
?>
<div id="main" style="margin-left:200px">

<div class="w3-container w3-display-container">
	 <span title="open Sidebar" style="display:none" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">&#9776;</span>
	 <div class="modal-content" style="margin-top:50px;">
        <div class="modal-header" style="padding:5px 5px;">
       The Aqua Supplier
        </div>
        <div class="modal-body" style="padding:5px 5px;">
		<?php
			include('DailyReport.php');
		?>
        </div>
       
      </div>
	
	 </div>
</div>
	
</div>

</body>
</html> 

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