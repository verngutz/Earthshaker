<?
	include ('warehousehead.php');
	if(!isset($_POST['submitsupplier']))
	{
		header('Location: index.php');
	}
?>

<html>

	<head>
		<title></title>
	</head>
	
	<body>
	
		<h2>Delivery Confirmation</h2>
	
		<?
			echo "<p>Date: " . $_POST['submityear1'] . "-" . $_POST['submitmonth1'] . "-" . $_POST['submitday1'] . "</p>";
			echo "<p>Time: " . $_POST['submithour1'] . $_POST['submitminute1'] . "</p>";
			echo "<p>Supplier: " . $_POST['submitsupplier'] . "</p>";
			echo "<table>";
			echo "<tr>";
				echo "<th>Item ID</th>";
				echo "<th>Item Description</th>";
				echo "<th>Cost</th>";
				echo "<th>Quantity</th>";
			echo "</tr>";
			
			$itempieces = explode("$", $_POST['submititems1']);
			for($i = 0; $i < count($itempieces) - 4; $i += 4)
			{
				echo "<tr>";
					echo "<td>" . $itempieces[$i] . "</td>";
					echo "<td>" . $itempieces[$i + 1] . "</td>";
					echo "<td>" . $itempieces[$i + 2] . "</td>";
					echo "<td>" . $itempieces[$i + 3] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		?>
		
		<form action = "processdeli.php" method = "post">
			<input type = "hidden" id = "submityear1" name = "submityear1" value = "<? echo $_POST['submityear1']; ?>">
			<input type = "hidden" id = "submitmonth1" name = "submitmonth1" value = "<? echo $_POST['submitmonth1']; ?>">
			<input type = "hidden" id = "submitday1" name = "submitday1" value = "<? echo $_POST['submitday1']; ?>">
			<input type = "hidden" id = "submithour1" name = "submithour1" value = "<? echo $_POST['submithour1']; ?>">
			<input type = "hidden" id = "submitminute1" name = "submitminute1" value = "<? echo $_POST['submitminute1']; ?>">
			<input type = "hidden" id = "submitsupplier" name = "submitsupplier" value = "<? echo $_POST['submitsupplier']; ?>">
			<input type = "hidden" id = "submititems1" name = "submititems1" value = "<? echo $_POST['submititems1']; ?>">
            <input type = "submit" value = "Confirm">
		</form>
		
		<form action = "warehouse.php" method = "post">
            <input type = "submit" value = "Cancel">
		</form>
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>