<?
	function getItemsFromDB()
	{
		$result = mysql_query("SELECT * FROM item");

		while($row = mysql_fetch_array($result))
		{
			echo "<option value = ";
			echo $row['itemcode'];
			echo ">";
			echo $row['description'];
			echo "</option>";
		}
	}
	
	function getBatchFromDB($userID)
	{
		$result = mysql_query("SELECT * FROM batch WHERE agentid = " . $userID . " ORDER BY batchno DESC LIMIT 1");
		echo "<table>";
			echo "<tr>";
				echo "<th>Item ID</th>";
				echo "<th>Item Description</th>";
				echo "<th>Quantity</th>";
				echo "<th>SRP</th>";
			echo "</tr>";
		while($row = mysql_fetch_array($result))
		{
			$itemxbatchq = mysql_query("SELECT * FROM itemxbatch WHERE batchno = " . $row['batchno']);
			while($itemxbatch = mysql_fetch_array($itemxbatchq))
			{
				$itemq = mysql_query("SELECT * FROM item WHERE itemcode = " . $itemxbatch['itemcode']);
				$item = mysql_fetch_array($itemq);
				echo "<tr>";
					echo "<td>" . $itemxbatch['itemcode'] . "</td>";
					echo "<td>" . $item['description'] . "</td>";
					echo "<td>" . $itemxbatch['quantity'] . "</td>";
					echo "<td>" . $item['srp'] . "</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}
?>