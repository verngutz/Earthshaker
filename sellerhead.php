<?

	include("config.inc");
	session_start();

	if (!isset($_SESSION['userID']) || !isset($_SESSION['type']) || $_SESSION['type'] != "salesagent")
	{
		header('Location: index.php');
	}
	else
	{
		echo "<a href = \"logout.php\">Log Out</a>";
		$result = mysql_query("SELECT CONCAT(agentfirstname, \" \", agentlastname) AS 'name' 
			FROM agent WHERE agentid = '" . $_SESSION['userID'] . "'");
		echo "<h1>";
		while($row = mysql_fetch_array($result))
		{
			echo $row['name'];
		}
		echo "</h1>";
	}

?>