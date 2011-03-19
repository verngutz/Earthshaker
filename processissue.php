<?
	include ('warehousehead.php');
	if(!isset($_POST['submitagent']))
	{
		header('Location: index.php');
	}
	$error = false;
	
	if($_POST['newbatch'])
	{
		mysql_query("INSERT INTO batch (agentid) VALUES ('" . $_POST['submitagent'] . ")");
	}
	
	$batch = mysql_fetch_array(mysql_query("SELECT * FROM batch ORDER BY batchno DESC LIMIT 1"));
	$batchno = $batch['batchno'];
	
	mysql_query("INSERT INTO issuance (batchno, issuedate, agentid, staffid) VALUES("
		. $batchno . ", '"
		. $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "', " 
		. $_POST['submitagent'] . ", " 
		. $_SESSION['userID'] . ")") or $error = true;

	$itempieces = explode("$", $_POST['submititems2']);
	for($i = 0; $i < count($itempieces) - 4; $i += 4)
	{
		mysql_query("INSERT INTO itemxbatch (itemcode, batchno, quantity) VALUES('"
			. $itempieces[$i] . ", "
			. $batchno . ", "
			. $itempieces[$i + 2] . ") ON DUPLICATE KEY UPDATE itemxbatch SET quantity += "
			. $itempieces[$i + 2] . "WHERE itemcode = "
			. $itempieces[$i] . "AND batchno = "
			. $batchno) or $error = true;;
	}
	
	if(!$error)
	{
		echo "<p>Action Succeeded.</p>";
	}
	else
	{
		echo "<p>Action Failed. Please contact your network administrator.</p>";
		echo "<p>Reported error: " . mysql_error() . "</p>";
	}
	echo "<a href = 'warehouse.php'>Return to Main Page</a>";
?>