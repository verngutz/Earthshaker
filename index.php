<?
	session_start();
	include('sitehead.php');
	include('config.php');
	if (isset($_SESSION['userID'])) 
	{
		$id = $_SESSION['userID'];
		if(isset($_SESSION['type']))
		{
			$type = $_SESSION['type'];
			if ($type == "staff")
			{
				$result = mysql_query("SELECT * FROM staff WHERE staffid = '" . $id . "'"); 
				if (mysql_num_rows($result) == 1)
				{
					header("Location: warehouse.php");
				}
			}
			else if ($type == "salesagent")
			{
				$result = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'");
				if (mysql_num_rows($result) == 1)
				{
					header("Location: seller.php");
				}
			}
			else if ($type == "manager")
			{
				$result = mysql_query("SELECT * FROM manager WHERE managerid = '" . $id . "'");
				if (mysql_num_rows($result) == 1)
				{
					header("Location: manager.php");
				}
			}	
		}
		if (isset($_SESSION['error']))
		{
			session_destroy();
		}
	}
	
			
	function getStoredID()
	{
		if(isset($_SESSION['userID']))
			echo $_SESSION['userID'];
		else
			echo "''";
	}

?>
		
<html>

	<head>
		<title></title>
		<script type = "text/javascript" src = "numericOnly.jsm"></script>
	</head>

	<body>
		
		<hr>
		
		<h2>Log In</h2>
		<form name = "userview" action = "login.php" method = "POST">
			<p>User ID: 
			<input type = "text" name = "userID" onkeypress = "return numericOnly(event);" value = <?  echo getStoredID(); ?> />
			</p>
			<input type = "submit" value = "Log In" />
		</form>
		<p id = "error"><? if (isset($_SESSION['error'])) echo $_SESSION['error']; ?></p>
		
		<hr>
				
	</body>
	
	<footer>
		© 2011 by Earthshaker
	</footer>

</html>