<?
	include ('sellerhead.php');
	if(!isset($_POST['submitagent']))
	{
		header('Location: index.php');
	}
	echo "<html><head><title>Action Results</title></head><body>";
	$error = false;
	$srcbatch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " 
		. $_SESSION['userID'] . " ORDER BY batchno DESC LIMIT 1")) or $error = true;
		
	if(mysql_num_rows(mysql_query("SELECT * FROM batch WHERE agentid = " . $_POST['submitagent'])) == 0)
	{
		mysql_query("INSERT INTO batch (agentid) VALUES (" . $_POST['submitagent'] . ")") or $error = true;
	}
	
	$destbatch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " 
		. $_POST['submitagent'] . " ORDER BY batchno DESC LIMIT 1")) or $error = true;
		
	$itempieces = explode("$", $_POST['submititems2']);
	for($i = 0; $i < count($itempieces) - 3; $i += 3)
	{
		mysql_query("INSERT INTO transfer (sourcebatch, desbatch, transferdate, itemcode, quantity) VALUES("
			. $srcbatch['batchno'] . ", "
			. $destbatch['batchno'] . ", '"
			. $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "', "
			. $itempieces[$i] . ", "
			. $itempieces[$i + 2] . ")")  or $error = true;
		
		mysql_query("UPDATE itemxbatch SET quantity = quantity - " 
			. $itempieces[$i + 2] . " WHERE itemcode = "
			. $itempieces[$i] . " AND batchno = " . $srcbatch['batchno']) or die(mysql_error());
			
		mysql_query("INSERT INTO itemxbatch (itemcode, batchno, quantity) VALUES("
			. $itempieces[$i] . ", "
			. $destbatch['batchno'] . ", "
			. $itempieces[$i + 2] . ") ON DUPLICATE KEY UPDATE quantity = quantity + " 
			. $itempieces[$i + 2] . " WHERE itemcode = "
			. $itempieces[$i] . " AND batchno = " . $destbatch['batchno']) or die(mysql_error());
	}
	mysql_query("DELETE FROM itemxbatch WHERE quantity = 0");
	
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
	echo "</body>";
	include('sitefoot.php');
	echo "</html>";
?>