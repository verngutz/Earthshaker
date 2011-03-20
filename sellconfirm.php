<?
	include('sellerhead.php');
	if(!isset($_POST['submititems1']))
	{
		header('Location: index.php');
	}
?>

<html>

	<head>
		<title></title>
	</head>
	
	<body>
	
		<h2>Invoice Confirmation</h2>

		<?
			echo "<p>" . $_POST['submititems1'] . "</p>";
			$id = $_SESSION['userID'];
			echo "<p>Date: " . $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "</p>";

			$client = mysql_fetch_array(mysql_query("SELECT * FROM client JOIN salesagent ON client.clientid = salesagent.clientid
				WHERE agentid = " . $id . ""));
			
			echo "<p>Client: " . $client['clientname'] . "</p>";
				
			echo "<table>";
			echo "<tr>";
				echo "<th>Item ID</th>";
				echo "<th>Item Description</th>";
				echo "<th>Quantity</th>";
			echo "</tr>";
			
			$itempieces = explode("$", $_POST['submititems1']);
			for($i = 0; $i < count($itempieces) - 3; $i += 3)
			{
				echo "<tr>";
					echo "<td>" . $itempieces[$i] . "</td>";
					echo "<td>" . $itempieces[$i + 1] . "</td>";
					echo "<td>" . $itempieces[$i + 2] . "</td>";
				echo "</tr>";
			}
			echo "</table>"
		?>
		
		<form action = "processinvoice.php" method = "post">
			<input type = "hidden" id = "submityear1" name = "submityear1" value = "<? echo $_POST['submityear2']; ?>">
			<input type = "hidden" id = "submitmonth1" name = "submitmonth1" value = "<? echo $_POST['submitmonth2']; ?>">
			<input type = "hidden" id = "submitday1" name = "submitday1" value = "<? echo $_POST['submitday2']; ?>">
			<input type = "hidden" id = "submititems1" name = "submititems1" value = "<? echo $_POST['submititems2']; ?>">
            <input type = "submit" value = "Confirm">
		</form>
		
		<form action = "seller.php" method = "post">
            <input type = "submit" value = "Cancel">
		</form>
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>