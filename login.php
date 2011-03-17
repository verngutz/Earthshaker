<?
	$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
	mysql_select_db("distribution", $con);
	header("Location: " . $_POST["group1"] . ".php");
?>