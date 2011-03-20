<?
	include ('warehousehead.php');
	if(!isset($_POST['submitagent']))
	{
		header('Location: index.php');
	}
?>

<html>

	<head>
		<title>Confirm Item Issuance</title>
	</head>
	
	<body>
	
		<h2>Issuance Confirmation</h2>
	
		<?
			$id = $_POST['submitagent'];
			$resulta = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'");
			if (mysql_num_rows($resulta) < 1)
			{
				echo "<p>Agent with ID #" . $id . " does not exist.</p>";
				echo "<a href = 'seller.php'>Return to Main Page</a>";
			}
			else
			{
				$result = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'");
				if (mysql_num_rows($result) < 1)
				{
					header("Location: warehouse.php");
				}
				$agent = mysql_fetch_array($result);
				echo "<p>Date: " . $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "</p>";
				echo "<p>Agent ID: " . $_POST['submitagent'] . "</p>";
				echo "<p>Agent Name: " . $agent['agentfirstname'] . " " . $agent['agentlastname'] . "</p>";
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
					echo "<th>SRP</th>";
				echo "</tr>";
				
				$itempieces = explode("$", $_POST['submititems2']);
				for($i = 0; $i < count($itempieces) - 3; $i += 3)
				{
					echo "<tr>";
						echo "<td>" . $itempieces[$i] . "</td>";
						echo "<td>" . $itempieces[$i + 1] . "</td>";
						echo "<td>" . $itempieces[$i + 2] . "</td>";
						$srp = mysql_fetch_array(mysql_query("SELECT * FROM item WHERE itemcode = " . $itempieces[$i]));
						echo "<td>" . $srp['srp'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "<form action = 'processissue.php' method = 'post'>";
					echo "<input type = 'hidden' id = 'submityear2' name = 'submityear2' value = \"" . $_POST['submityear2'] . "\">";
					echo "<input type = 'hidden' id = 'submitmonth2' name = 'submitmonth2' value = \"" . $_POST['submitmonth2'] . "\">";
					echo "<input type = 'hidden' id = 'submitday2' name = 'submitday2' value = \"" . $_POST['submitday2'] . "\">";
					echo "<input type = 'hidden' id = 'submitagent' name = 'submitagent' value = " . $_POST['submitagent'] . ">";
					echo "<input type = 'hidden' id = 'submititems2' name = 'submititems2' value = \"" . $_POST['submititems2'] . "\">";
					echo "<input type = 'submit' value = 'Confirm'>";
				echo "</form>";
		
				echo "<form action = 'warehouse.php' method = 'post'>";
					echo "<input type = 'submit' value = 'Cancel'>";
				echo "</form>";
			}
		?>
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>