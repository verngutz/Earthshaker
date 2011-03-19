<?
	include ('warehousehead.php');
	if(!isset($_POST['submitsupplier']))
	{
		header('Location: index.php');
	}
	$result = mysql_query("INSERT INTO delivery (deliverydate, deliverytime, staffid, supplier) VALUES('"
		. $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "', '" 
		. $_POST['submithour1'] . ":" . $_POST['submitminute1'] . ":00', " 
		. $_SESSION['userID'] .", '" 
		. $_POST['submitsupplier'] ."')");
		
	$itempieces = explode("$", $_POST['submititems1']);
	for($i = 0; $i < count($itempieces) - 4; $i += 4)
	{
		mysql_query("INSERT INTO deliveryxitem (itemcode, cost, quantity) VALUES('"
		. $itempieces[$i] . ", "
		. $itempieces[$i + 2] . ", "
		. $itempieces[$i + 3] . ")");
	}

	if($result)
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