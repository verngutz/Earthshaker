<?
	include("managerhead.php");
?>

<html>

	<head>
		<title>Manager's View</title>
	</head>

	<body>
		<form name = "userview" action = "redirect.php" method = "POST">
			<p>What report would you like to generate?</p>
			<input type = "radio" name = "group1" value = "manager-delivery-2" checked = "true"/>Delivery Receipt<br>
			<input type = "radio" name = "group1" value = "manager-invoice-2"/>Sales Invoice<br>
			<input type = "radio" name = "group1" value = "manager-itemissuance-2"/>Item Issuance Form<br>
			<input type = "radio" name = "group1" value = "manager-itemreturn-2"/>Item Return Form<br>
			<input type = "radio" name = "group1" value = "manager-itemtransfer-2"/>Item Transfer Form<br>
			<input type = "submit" value = "Print" />
		</form>
	</body>	

</html>