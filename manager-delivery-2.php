<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("SELECT d.deliveryid as 'deliveryid', d.deliverydate as 'deliverydate', d.deliverytime as 'deliverytime', concat(staff.stafflname, ', ', staff.stafffname) as 'name', d.supplier as 'supplier' FROM delivery d, staff WHERE deliveryid=$_POST['input1'] and staff.staffid=delivery.staffid LIMIT 1 ");

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
		  echo "<td>" . $row['name'] . "</td>";
		  echo "<td>" . $row['supplier'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		$result2 = mysql_query("SELECT i.itemcode as 'itemcode', i.description as 'desc', di.quantity as 'quant', di.cost as 'cost', (di.quantity*di.cost) as 'total' FROM delivery d, item i, deliveryxitem di WHERE delivery.deliveryid=$_POST['input1'] AND delivery.deliveryid=deliveryxitem.deliveryid AND item.itemcode=deliveryxitem.itemcode");
		
		echo "<table border='1'>
		<tr>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>
		<th>Cost</th>
		<th>Total</th>
		</tr>";
		
		while($row = mysql_fetch_array($result2))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "<td>" . $row['cost'] . "</td>";
		  echo "<td>" . $row['total'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		?> 
		
	</body>
</html>