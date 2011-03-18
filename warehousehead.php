<?

	include("config.php");
	session_start();

	if (!isset($_SESSION['userID']) || !isset($_SESSION['type']) || $_SESSION['type'] != "staff")
	{
		header('Location: index.php');
	}
	else
	{
		include("sitehead.php");
		$result = mysql_query("SELECT CONCAT(stafffirstname, ' ', stafflastname) AS 'name' 
			FROM staff WHERE staffid = '" . $_SESSION['userID'] . "'");
		echo "<h1>";
		while($row = mysql_fetch_array($result))
		{
			echo $row['name'];
		}
		echo "</h1>";
		echo "<a id = 'logout' href = 'logout.php'>Log Out</a>";
		echo "<hr>";
	}
	
	include("getitems.php");
	
?>