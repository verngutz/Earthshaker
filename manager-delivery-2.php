<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("
		
		SELECT d.deliveryid as 'deliveryid', d.deliverydate as 'deliverydate', d.deliverytime as 'deliverytime',
		concat(s.stafflastname, ', ', s.stafffirstname) as 'name', d.supplier as 'supplier', i.itemcode as 'itemcode',
		i.description as 'desc', di.quantity as 'quant', di.cost as 'cost', (di.quantity*di.cost) as 'total'
		FROM delivery d, staff s, item i, deliveryxitem di
		WHERE s.staffid=d.staffid AND d.deliveryid=di.deliveryid AND i.itemcode=di.itemcode
		ORDER BY d.deliveryid
		
		");

		echo "<table border='1'>
		<tr>
		<th>Delivery ID</th>
		<th>Date</th>
		<th>Delivery Time</th>
		<th>Delivery Receiver</th>
		<th>Delivery Supplier</th>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>
		<th>Cost</th>
		<th>Total</th>		
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['deliveryid'] . "</td>";
		  echo "<td>" . $row['deliverydate'] . "</td>";
		  echo "<td>" . $row['deliverytime'] . "</td>";
		  echo "<td>" . $row['name'] . "</td>";
		  echo "<td>" . $row['supplier'] . "</td>";
		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "<td>" . $row['cost'] . "</td>";
		  echo "<td>" . $row['total'] . "</td>";		  
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		?> 
		
	</body>
</html>