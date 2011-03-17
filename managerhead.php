<?

	include("config.inc");
	session_start();

	if (!isset($_SESSION['userID']) || !isset($_SESSION['type']) || $_SESSION['type'] != "manager")
	{
		header('Location: index.php');
	}
	else
	{
		echo "<a href = \"logout.php\">Log Out</a>";
		$result = mysql_query("SELECT CONCAT(managerfirstname, \" \", managerlastname) AS 'name' 
			FROM manager WHERE managerid = '" . $_SESSION['userID'] . "'");
		echo "<h1>";
		while($row = mysql_fetch_array($result))
		{
			echo $row['name'];
		}
		echo "</h1>";
	}

?>