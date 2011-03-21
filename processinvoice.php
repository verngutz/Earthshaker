<?
	include ('sellerhead.php');
	if(!isset($_POST['submititems1']))
	{
		header('Location: index.php');
	}
	echo "<html><head><title>Action Results</title></head><body>";
	$error = false;
	$result = mysql_query("INSERT INTO invoice (invoicedate, agentid) VALUES('"
		. $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "', "
		. $_SESSION['userID'] .")") or $error = true;
	$invoice = mysql_fetch_array(mysql_query("SELECT * FROM invoice ORDER BY invoiceno DESC LIMIT 1"))  or $error = true;
	$invoiceno = $invoice['invoiceno'];
	$itempieces = explode("$", $_POST['submititems1']);
	for($i = 0; $i < count($itempieces) - 3; $i += 3)
	{
		mysql_query("INSERT INTO itemxinvoice (invoiceno, itemcode, quantity) VALUES("
			. $invoiceno . ", "
			. $itempieces[$i] . ", "
			. $itempieces[$i + 2] . ")")  or $error = true;
			
		$batch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " . $_SESSION['userID'] . " ORDER BY batchno DESC LIMIT 1"));
		
		mysql_query("UPDATE itemxbatch SET quantity = quantity - " 
			. $itempieces[$i + 2] . " WHERE itemcode = "
			. $itempieces[$i] . " AND batchno = " . $batch['batchno']);
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