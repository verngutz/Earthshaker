<?
	include ('warehousehead.php');
	if(!isset($_POST['submitagent']))
	{
		header('Location: index.php');
	}
	
	echo "<html><head><title>Action Results</title></head><body>";
	$error = false;
	
	if(mysql_num_rows(mysql_query("SELECT * FROM batch WHERE agentid = " . $_POST['submitagent'])) == 0)
	{
		mysql_query("INSERT INTO batch (agentid) VALUES (" . $_POST['submitagent'] . ")") or $error = true;
	}
	
	$batch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " 
		. $_POST['submitagent'] . " ORDER BY batchno DESC LIMIT 1")) or $error = true;
	$batchno = $batch['batchno'];

	$itempieces = explode("$", $_POST['submititems2']);
	for($i = 0; $i < count($itempieces) - 3; $i += 3)
	{
		mysql_query("INSERT INTO itemxbatch (itemcode, batchno, quantity) VALUES("
			. $itempieces[$i] . ", "
			. $batchno . ", "
			. $itempieces[$i + 2] . ") ON DUPLICATE KEY UPDATE quantity = quantity + "
			. $itempieces[$i + 2]);
			
		mysql_query("INSERT INTO issuance (batchno, issuedate, agentid, staffid, itemcode, quantity) VALUES("
			. $batchno . ", '"
			. $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "', " 
			. $_POST['submitagent'] . ", " 
			. $_SESSION['userID'] . ", "
			. $itempieces[$i] . ", "
			. $itempieces[$i + 2] . ") ON DUPLICATE KEY UPDATE quantity = quantity + "
			. $itempieces[$i + 2]);
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