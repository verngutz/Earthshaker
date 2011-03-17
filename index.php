<?
	session_start();
	include('config.inc');
	if (isset($_SESSION['userID'])) 
	{
		$id = $_SESSION['userID'];
		if(isset($_SESSION['type']))
		{
			$type = $_SESSION['type'];
			if ($type = "staff")
			{
				$result = mysql_query("SELECT * FROM staff WHERE staffid = '" . $id . "'"); 
				if (mysql_num_rows($result) == 1)
				{
					header("Location: warehouse.php");
				}
			}
			else if ($type = "salesagent")
			{
				$result = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'");
				if (mysql_num_rows($result) == 1)
				{
					header("Location: seller.php");
				}
			}
			else if ($type = "manager")
			{
				$result = mysql_query("SELECT * FROM manager WHERE managerid = '" . $id . "'");
				if (mysql_num_rows($result) == 1)
				{
					header("Location: manager.php");
				}
			}	
		}
		else if (isset($_SESSION['error']))
		{
			session_destroy();
		}
	}
	
			
	function getStoredID()
	{
		if(isset($_SESSION['userID']))
			echo $_SESSION['userID'];
	}

?>
		
<html>

	<head>
		<title></title>
		<script type = "text/javascript" src = "numericOnly.jsm"></script>
	</head>

	<body>

		<h1>Earthshaker</h1>
		
		<h2>Log In</h2>
		<form name = "userview" action = "login.php" method = "POST">
			<p>User ID: 
			<? 
				echo "<input type = \"text\"";
				echo "name = \"userID\"";
				echo "onkeypress = \"return numericOnly(event);\""; 
				echo "value = "; 
				echo getStoredID();
				echo ">";
			?>
			</p>
			<input type = "submit" value = "Log In" />
		</form>
		<p id = "error"><? if (isset($_SESSION['error'])) echo $_SESSION['error']; ?></p>
				
	</body>	

</html>