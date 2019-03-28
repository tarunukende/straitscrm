<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php'); ?>
<?php 

	error_reporting(0);
	
	$merchant_data='142405';
	$working_key='AVRN72EG17CD18NRDC';//Shared by CCAVENUES
	$access_code='3808661661C33505C3A0BC3FBB388E4E';//Shared by CCAVENUES
	
	// print_r($_POST);

	$Array['tid'] = '1526471998776';
	$Array['merchant_id'] = '14240';
	$Array['order_id'] = '123654789';
	$Array['amount'] = '1.00';
	$Array['currency'] = 'USD';
	$Array['redirect_url'] = 'http://reportsmonitors.com/gateway/ccavResponseHandler.php';
	$Array['cancel_url'] = 'http://reportsmonitors.com/gateway/ccavResponseHandler.php';
	$Array['language'] = 'EN';
	$Array['billing_name'] = 'azar';
	$Array['billing_address'] = 'demo';
	$Array['billing_city'] = 'pune';
	$Array['billing_state'] = 'MH';
	$Array['billing_zip'] = '410048';
	$Array['billing_country'] = 'India';
	$Array['billing_tel'] = '9762808909';
	$Array['billing_email'] = 'azar.sayyed16@gmail.com';

	foreach ($Array as $key => $value)
	{
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

