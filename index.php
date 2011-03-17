<html>

	<head>
		<title></title>
		<script type = "text/javascript" src = "numericOnly.jsm"></script>
		<?
			function getID()
			{
				echo $_POST["userID"];
			}
		?>
	</head>

	<body>
	
		<h1>Earthshaker</h1>
		
		<h2>Log In</h2>
		<form name = "userview" action = "login.php" method = "POST">
			<input type = "text" name = "userID" value = <? getID(); ?> onkeypress = "return numericOnly(event);" />
			<input type = "submit" value = "Log In" />
		</form>
				
	</body>	

</html>