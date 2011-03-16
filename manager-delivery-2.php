<html>
	<body>

		<?php
		$con = mysql_connect("localhost","","");
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }

		mysql_select_db("jv", $con);

		$result = mysql_query("SELECT * FROM delivery WHERE delivery.deliveryid=$_POST["input1"]);

		echo "<table border='1'>
		<tr>
		<th>Delivery ID</th>
		<th>Date</th>
		<th>Delivery Time</th>
		<th>Delivery Receiver</th>
		<th>Delivery Supplier</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['deliveryid'] . "</td>";
		  echo "<td>" . $row['deliverydate'] . "</td>";
		  echo "<td>" . $row['deliverytime'] . "</td>";
		  echo "<td>" . $row['deliveryreceiver'] . "</td>";
		  echo "<td>" . $row['deliverysupplier'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		
		
		
		

		mysql_close($con);
		?> 
		
	</body>
</html>