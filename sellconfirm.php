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
			$id = $_SESSION['userID'];
			echo "<p>Date: " . $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "</p>";

			$client = mysql_fetch_array(mysql_query("SELECT * FROM client JOIN salesagent ON client.clientid = salesagent.clientid
				WHERE agentid = " . $id));
			
			echo "<p>" . $client['clientid'] . "</p>";
			echo "<p>Client: " . $client['clientname'] . "</p>";
				
			echo "<table>";
			echo "<tr>";
				echo "<th>Item ID</th>";
				echo "<th>Item Description</th>";
				echo "<th>Quantity</th>";
				echo "<th>SRP</th>";
				echo "<th>Discount</th>";
				echo "<th>Sale Price</th>";
			echo "</tr>";
			
			$grandtotal = 0;
			$itempieces = explode("$", $_POST['submititems1']);
			for($i = 0; $i < count($itempieces) - 3; $i += 3)
			{
				echo "<tr>";
					echo "<td>" . $itempieces[$i] . "</td>";
					echo "<td>" . $itempieces[$i + 1] . "</td>";
					echo "<td>" . $itempieces[$i + 2] . "</td>";
					$item = mysql_fetch_array(mysql_query("SELECT * FROM item WHERE itemcode = " . $itempieces[$i]));
					echo "<td>" . $item['srp'] . "</td>";
					$discountq = mysql_query("SELECT * FROM discount WHERE itemcode = " 
						. $itempieces[$i] . " AND clientid = "
						. $client['clientid']);
					$discountamount = 0;
					if(mysql_num_rows($discountq) == 1)
					{
						$discount = mysql_fetch_array($discountq);
						$discountamount = $discount['amount'];
						echo "<td>" . $discountamount . "</td>";
					}
					else
					{
						echo "<td>None</td>";
					}
					$saleprice = $itempieces[$i + 2] * $item['srp'] * (1 - $discountamount);
					$grandtotal += $saleprice;
					echo "<td>" . $saleprice . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "<p>Grand Total: " . $grandtotal . "</p>";
		?>
		
		<form action = "processinvoice.php" method = "post">
			<input type = "hidden" id = "submityear1" name = "submityear1" value = "<? echo $_POST['submityear1']; ?>">
			<input type = "hidden" id = "submitmonth1" name = "submitmonth1" value = "<? echo $_POST['submitmonth1']; ?>">
			<input type = "hidden" id = "submitday1" name = "submitday1" value = "<? echo $_POST['submitday1']; ?>">
			<input type = "hidden" id = "submititems1" name = "submititems1" value = "<? echo $_POST['submititems1']; ?>">
            <input type = "submit" value = "Confirm">
		</form>
		
		<form action = "seller.php" method = "post">
            <input type = "submit" value = "Cancel">
		</form>
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>