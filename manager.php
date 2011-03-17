<?
	include("config.inc");
	include("managerhead.php");
?>

<html>

	<head>
		<title>Manager's View</title>
	</head>

	<body>
		<form name = "userview" action = "redirect.php" method = "POST">
			<p>What report would you like to generate?</p>
			<input type = "radio" name = "group1" value = "manager-delivery" checked = "true"/>Delivery Receipt<br>
			<input type = "radio" name = "group1" value = "manager-invoice"/>Sales Invoice<br>
			<input type = "radio" name = "group1" value = "manager-itemissuance"/>Item Issuance Form<br>
			<input type = "radio" name = "group1" value = "manager-itemreturn"/>Item Return Form<br>
			<input type = "radio" name = "group1" value = "manager-itemtransfer"/>Item Transfer Form<br>
			<input type = "submit" value = "Print" />
		</form>
	</body>	

</html>