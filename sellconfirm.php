<?
	include('sellerhead.php');
	if(!isset($_POST['submititems1'])
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
			$id = $_SESSION['userID'];
			$agent = mysql_fetch_array(mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'"));
			echo "<p>Date: " . $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "</p>";
			echo "<p>Agent ID: " . $agent['agentid'] . "</p>";
			echo "<p>Agent Name: " . $agent['agentfirstname'] . " " . $agent['agentlastname'] . "</p>";
			echo "<p>Type of Action: ";
			echo "</p>";
			if($agent['clientid'] != "")
			{
				$client = mysql_query("SELECT clientname FROM client WHERE clientid = '" . $agent['clientid'] . "'");
				$clientname = mysql_fetch_array($client);
				echo "<p>Client: " . $clientname['clientname'];
			}
			echo "<table>";
			echo "<tr>";
				echo "<th>Item ID</th>";
				echo "<th>Item Description</th>";
				echo "<th>Quantity</th>";
			echo "</tr>";
			
			$itempieces = explode("$", $_POST['submititems2']);
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
		
		<form action = "processissue.php" method = "post">
			<input type = "hidden" id = "submityear2" name = "submityear2" value = <? echo $_POST['submityear2']; ?>>
			<input type = "hidden" id = "submitmonth2" name = "submitmonth2" value = <? echo $_POST['submitmonth2']; ?>>
			<input type = "hidden" id = "submitday2" name = "submitday2" value = <? echo $_POST['submitday2']; ?>>
			<input type = "hidden" id = "submitagent" name = "submitagent" value = <? echo $_POST['submitagent']; ?>>
			<input type = "hidden" id = "submititems2" name = "submititems2" value = <? echo $_POST['submititems2']; ?>>
			<input type = "hidden" id = "newbatch" name = "newbatch" value = <? echo isset($_POST['newbatch']); ?>>
            <input type = "submit" value = "Confirm">
		</form>
		
		<form action = "warehouse.php" method = "post">
            <input type = "submit" value = "Cancel">
		</form>
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>