<?
	include ('warehousehead.php');
	if(!isset($_POST['submitagent']))
	{
		header('Location: index.php');
	}
	$result = mysql_query("INSERT INTO batch (batchdate, agentid, staffid) VALUES('"
		. $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "', '" 
		. $_POST['submitagent'] . "', '" 
		. $_SESSION['userID'] . "')") or die(mysql_error());
	
	if($result)
	{
		echo "<p>Success!</p>";
		echo "<a href = 'warehouse.php'>Return to Main Page</a>";
	}
?>