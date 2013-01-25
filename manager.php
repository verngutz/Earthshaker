<?
	include("managerhead.php");
?>

<html>

	<head>
		<title>Manager's View</title>
		<script type="text/javascript">
		
			function redirect(form, name)
			{
				for (var i = 0; i < form.elements.length; i++)
				{
					if(form.elements[i].name == name && form.elements[i].checked)
						form.action = form.elements[i].value;
				}
			}
			
		</script>
	</head>

	<body>
		<form name = "userview" action = "#" method = "POST" onsubmit = "redirect(this, 'group1');"/>
			<h2>What report would you like to generate?</h2>
			<input type = "radio" name = "group1" value = "manager-delivery-2.php" checked = "true"/>Delivery Receipt<br>
			<input type = "radio" name = "group1" value = "manager-invoice-2.php"/>Sales Invoice<br>
			<input type = "radio" name = "group1" value = "manager-itemissuance-2.php"/>Item Issuance Form<br>
			<input type = "radio" name = "group1" value = "manager-itemreturn-2.php"/>Item Return Form<br>
			<input type = "radio" name = "group1" value = "manager-itemtransfer-2.php"/>Item Transfer Form<br>
			<input type = "submit" value = "Print" />
		</form>
	</body>	

	<footer>
		© 2011 by Earthshaker
	</footer>
	
</html>