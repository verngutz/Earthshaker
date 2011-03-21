<?
	include ('sellerhead.php');
	if(!isset($_POST['submititems3']))
	{
		header('Location: index.php');
	}
	
	echo "<html><head><title>Action Results</title></head><body>";
	$error = false;
	$batch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " 
		. $_SESSION['userID'] . " ORDER BY batchno DESC LIMIT 1")) or $error = true;
	mysql_query("INSERT INTO itemreturn (batchno, returndate) VALUES (" 
		. $batch['batchno'] . ", '"
		. $_POST['submityear3'] . "-" . $_POST['submitmonth3'] . "-" . $_POST['submitday3'] ."')") or $error = true;
	mysql_query("INSERT INTO batch (agentid) VALUES (" . $_SESSION['userID'] . ")") or $error = true;
	
	if(!$error)
	{
		echo "<p>Action Succeeded.</p>";
	}
	else
	{
		echo "<p>Action Failed. Please contact your network administrator.</p>";
		echo "<p>Reported error: " . mysql_error() . "</p>";
	}
	echo "<a href = 'seller.php'>Return to Main Page</a>";
	echo "<a href = 'warehouse.php'>Return to Main Page</a>";
	echo "</body>";
	include('sitefoot.php');
	echo "</html>";
?>