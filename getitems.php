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
?>