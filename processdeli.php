<?
	include ('warehousehead.php');
	if(!isset($_POST['submitsupplier']))
	{
		header('Location: index.php');
	}
	$result = mysql_query("INSERT INTO delivery (deliverydate, deliverytime, staffid, supplier) VALUES('"
		. $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "', '" 
		. $_POST['submithour1'] . ":" . $_POST['submitminute1'] . ":00', '" 
		. $_SESSION['userID'] ."', '" 
		. $_POST['submitsupplier'] ."'") or die(mysql_error());
?>