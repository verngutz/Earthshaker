<?
	include('sellerhead.php');
	if(!isset($_POST['submitagent']))
	{
		header('Location: index.php');
	}
?>

<html>

	<head>
		<title>Confirm Item Transfer</title>
	</head>
	
	<body>
	
		<h2>Transfer Confirmation</h2>

		<?
			$result = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $_POST['submitagent'] . "'");
			if (mysql_num_rows($result) < 1)
			{
				echo "<p>Agent with ID #" . $_POST['submitagent']. " does not exist.</p>";
				echo "<a href = 'seller.php'>Return to Main Page</a>";
			}
			else
			{
				$id = $_SESSION['userID'];
				echo "<p>Date: " . $_POST['submityear2'] . "-" . $_POST['submitmonth2'] . "-" . $_POST['submitday2'] . "</p>";

				$agent = mysql_fetch_array(mysql_query("SELECT * FROM salesagent WHERE agentid = " . $_POST['submitagent']));
				$srcbatch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " . $id . " ORDER BY batchno DESC LIMIT 1"));
				if(mysql_num_rows(mysql_query("SELECT * FROM batch WHERE agentid = " . $_POST['submitagent'])) == 0)
				{
					mysql_query("INSERT INTO batch (agentid) VALUES (" . $_POST['submitagent'] . ")") or $error = true;
				}
				$destbatch = mysql_fetch_array(mysql_query("SELECT * FROM batch WHERE agentid = " 
					. $_POST['submitagent'] . " ORDER BY batchno DESC LIMIT 1"));
				echo "<p>Transfer from batch: " . $srcbatch['batchno'] . "</p>";
				echo "<p>Transfer to: " . $agent['agentfirstname'] . " " . $agent['agentlastname'] . ", batch: " . $destbatch['batchno'] . "</p>";
					
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
						$item = mysql_fetch_array(mysql_query("SELECT * FROM item WHERE itemcode = " . $itempieces[$i]));
						echo "<td>" . $item['srp'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
				
				echo "<form action = 'processtransfer.php' method = 'post'>";
					echo "<input type = 'hidden' id = 'submityear2' name = 'submityear2' value = \"" . $_POST['submityear2'] ."\">";
					echo "<input type = 'hidden' id = 'submitmonth2' name = 'submitmonth2' value = \"" . $_POST['submitmonth2'] ."\">";
					echo "<input type = 'hidden' id = 'submitday2' name = 'submitday2' value = \"" . $_POST['submitday2'] . "\">";
					echo "<input type = 'hidden' id = 'submititems2' name = 'submititems2' value = \"" . $_POST['submititems2'] . "\">";
					echo "<input type = 'hidden' id = 'submitagent' name = 'submitagent' value = \"" . $_POST['submitagent'] . "\">";
					echo "<input type = 'submit' value = 'Confirm'>";
				echo "</form>";
		
				echo "<form action = 'seller.php' method = 'post'>";
					echo "<input type = 'submit' value = 'Cancel'>";
				echo "</form>";
			}
		?>
		
		
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>