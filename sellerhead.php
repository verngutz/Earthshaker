<?

	include("sitehead.php");
	include("config.php");
	session_start();

	if (!isset($_SESSION['userID']) || !isset($_SESSION['type']) || $_SESSION['type'] != "salesagent")
	{
		header('Location: index.php');
	}
	else
	{
		$result = mysql_query("SELECT CONCAT(agentfirstname, ' ', agentlastname) AS 'name' 
			FROM salesagent WHERE agentid = '" . $_SESSION['userID'] . "'");
		echo "<h1>";
		while($row = mysql_fetch_array($result))
		{
			echo $row['name'];
		}
		echo "</h1>";
		echo "<h2>What would you like to do?</h2>";
		echo "<a id = 'logout' href = 'logout.php'>Log Out</a>";
	}

	include("getitems.php");
	
?>