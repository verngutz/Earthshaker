<?
	function getItemsFromDB()
	{
		$result = mysql_query("SELECT description FROM item");

		while($row = mysql_fetch_array($result))
		{
			echo "<option>";
			echo $row['description'];
			echo "</option>";
		}
	}
?>