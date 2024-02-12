 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 <form method="POST">
	<input type="submit" name="btnSave" value="Send SMS" />
	<?php
		if(isset($_POST['btnSave']))
		{
			// Account details
    	$apiKey = urlencode('ShIrsgqs2Xc-QbIY3srV2WNzervNj9ZqrSutGzZopB');
    	
    	// Message details
    	$numbers = array(919904818508);
    	$sender = urlencode('TXTLCL');
    	$message = rawurlencode('This is your message');
     
    	$numbers = implode(',', $numbers);
     
    	// Prepare data for POST request
    	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
     
    	// Send the POST request with cURL
    	$ch = curl_init('https://api.textlocal.in/send/');
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($ch);
    	curl_close($ch);
    	
    	// Process your response here
    	echo $response;
		}
	?>
 </form>
 
</div>

</body>
</html> 
	    
	