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
	
	function getWarehouseQuantity()
	{
		$result = mysql_query("SELECT * FROM item");

		while($row = mysql_fetch_array($result))
		{
			$itemcode = $row['itemcode'];
			$calcdeliveredquantity = mysql_query("SELECT * FROM deliveryxitem WHERE itemcode = " . $itemcode);
			$deliveredquantity = 0;
			while($delirow = mysql_fetch_array($calcdeliveredquantity))
			{
				$deliveredquantity += $delirow['quantity'];
			}
			$calcissuedquantity = mysql_query("SELECT * FROM itemxbatch WHERE itemcode = " . $itemcode);
			$issuedquantity = 0;
			while($issuerow = mysql_fetch_array($calcissuedquantity))
			{
				$issuedquantity += $issuerow['quantity'];
			}
			$calcreturnedquantity = mysql_query("SELECT * FROM itemreturn 
				JOIN itemxbatch ON itemxbatch.batchno = itemreturn.batchno WHERE itemxbatch.itemcode = " . $itemcode);
			$returnedquantity = 0;
			while($returnrow = mysql_fetch_array($calcreturnedquantity))
			{
				$returnedquantity += $returnrow['quantity'];
			}
			$availablequantity = $deliveredquantity - $issuedquantity + $returnedquantity;
			echo "<option value = ";
			echo $row['itemcode'] . ": ";
			echo ">";
			echo $availablequantity;
			echo "</option>";
		}
	}
	
	function getBatchFromDB($userID)
	{
		$batch = mysql_query("SELECT * FROM batch WHERE agentid = " . $userID . " ORDER BY batchno DESC LIMIT 1");
		if(mysql_num_rows($batch) == 0)
		{
			echo "<p>No items in hand</p>";
		}
		else
		{
			echo "<table id = 'batchTable'>";
				echo "<tr>";
					echo "<th>Item ID</th>";
					echo "<th>Item Description</th>";
					echo "<th>Quantity</th>";
					echo "<th>SRP</th>";
				echo "</tr>";
			while($row = mysql_fetch_array($batch))
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
	}
	
	function getClient($userID)
	{
		$getAgent = mysql_query("SELECT * FROM salesagent WHERE agentid = " . $userID);
		if(mysql_num_rows($getAgent) != 0)
		{
			$agent = mysql_fetch_array($getAgent);
			$client = mysql_fetch_array(mysql_query("SELECT * FROM client WHERE clientid = " . $agent['clientid']));
			echo $client['clientname'];
		}
		else
		{
			echo "None";
		}
	}
?>