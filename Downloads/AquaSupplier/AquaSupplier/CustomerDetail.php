<?php
include_once('connection.php');
if (!isset($_SESSION['name'])) {
//	header('location:index.php');
	echo "<script>window.location='index.php'</script>";	
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Indian Slipper Mart" />
<meta name="author" content="Indian Slipper Mart" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="plugins/flexslider/flexslider.css" rel="stylesheet" media="screen" />	
<link href="css/cubeportfolio.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
 <script src="bootstrap/js/shortcuts_v1.js" type="text/javascript"></script>
<script src="bootstrap/js/shortcuts.js" type="text/javascript"></script>
<!-- Theme skin -->
<link id="t-colors" href="skins/default.css" rel="stylesheet" />

	<!-- boxed bg -->
	<link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<style>
		.mar{
		margin-top:20px;
		}
	</style>

</head>
<body onkeydown="keyCode(event)">

<form action="" method="POST">
<div id="wrapper">
	<!-- start header -->
	<header>	
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <a class="navbar-brand" href="indexDemo.php"><h2>New Indian Slipper Mart</h2></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="indexDemo.php">Home</a></li>
                        
						 <li class="dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false"> Products <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
                                <li><a href="addproduct.php">Add Product</a></li>
								<li><a href="AddCategory.php">Add Category</a></li>
                                <li><a href="ProductDetail.php">Product Detail</a></li>
								<li><a href="#">Low Product</a></li>
								
                            </ul>
						</li>
						
						 <li class="dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false"> Customer <i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu">
                                <li><a href="AddCustomer.php">Add Customer</a></li>
                                <li><a href="CustomerDetail.php">Customer Detail</a></li>
								<li><a href="#">Customer Due</a></li>
								
                            </ul>
						</li>
						
						<li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->

</div>

	<!-- Main Body Starts -->
<div class="container mar">
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<table class="table">
				<thead>
					<th>Customer Name</th>
					<th>Contact</th>
					<th>Tin No</th>
					<th>Address/City</th>
				</thead>
				<tbody>
					<?php
						$dispcust=mysql_query("select * from customer_detail");
						while($row=mysql_fetch_array($dispcust))
						{
					?>
					<tr>
							<td><?php echo $row['customer_name']; ?></td>
							<td><?php echo $row['customer_contact']; ?></td>
							<td><?php echo $row['customer_tin']; ?></td>
							<td><?php echo $row['customer_address']; ?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-2">
		</div>
	</div>	
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="plugins/flexslider/jquery.flexslider-min.js"></script> 
<script src="plugins/flexslider/flexslider.config.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/stellar.js"></script>
<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script src="js/jquery.cubeportfolio.min.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>

</form>	
</body>
</html>