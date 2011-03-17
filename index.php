<html>

	<head>
		<title></title>
	</head>

	<body>
	
		<?
			$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
			mysql_select_db("distribution", $con);
		?>
		
		<form name = "userview" action = "redirect.php" method = "POST">
			<p>Which type of user are you?</p>
			<input type = "radio" name = "group1" value = "manager" checked = "true"/>Manager<br>
			<input type = "radio" name = "group1" value = "seller"/>Sales Agent<br>
			<input type = "radio" name = "group1" value = "warehouse"/>Warehouse Staff<br>
			<input type = "submit" value = "Log In" />
		</form>
	</body>	

</html>