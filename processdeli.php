<?
	include ('warehousehead.php');
	if(!isset($_POST['submitsupplier']))
	{
		header('Location: index.php');
	}
	echo "<html><head><title>Action Results</title></head><body>";
	$error = false;
	$result = mysql_query("INSERT INTO delivery (deliverydate, deliverytime, staffid, supplier) VALUES('"
		. $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "', '" 
		. $_POST['submithour1'] . ":" . $_POST['submitminute1'] . ":00', " 
		. $_SESSION['userID'] .", '" 
		. $_POST['submitsupplier'] ."')") or $error = true;
	$delivery = mysql_fetch_array(mysql_query("SELECT * FROM delivery ORDER BY deliveryid DESC LIMIT 1"))  or $error = true;
	$deliid = $delivery['deliveryid'];
	$itempieces = explode("$", $_POST['submititems1']);
	for($i = 0; $i < count($itempieces) - 4; $i += 4)
	{
		mysql_query("INSERT INTO deliveryxitem (deliveryid, itemcode, cost, quantity) VALUES("
		. $deliid . ", "
		. $itempieces[$i] . ", "
		. $itempieces[$i + 2] . ", "
		. $itempieces[$i + 3] . ")")  or $error = true;
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