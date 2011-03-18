<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("SELECT b.batchno as 'batchno', b.batchdate as 'batchdate', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname', c.clientname as 'clientname', b.issuer as 'issuer', i.itemcode as 'itemcode', i.description as 'desc', ib.quantity as 'quant', i.srp as 'srp'
		FROM batch b, salesagent s, client c, item i, itemxbatch ib
		WHERE batch.agentid=salesagent.agentid AND salesagent.clientid=client.clientid AND itemxbatch.batchno=batch.batchno AND item.itemcode=itemxbatch.itemcode
		ORDER BY batch.batchno");

		echo "<table border='1'>
		<tr>
		<th>Batch</th>
		<th>Date</th>
		<th>Agent</th>
		<th>Client</th>
		<th>Issuer</th>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>
		<th>SRP</th>		
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['batchno'] . "</td>";
		  echo "<td>" . $row['batchdate'] . "</td>";
		  echo "<td>" . $row['agentname'] . "</td>";
		  echo "<td>" . $row['clientname'] . "</td>";
		  echo "<td>" . $row['issuer'] . "</td>";
		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "<td>" . $row['srp'] . "</td>";		  
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		mysql_close($con);
		?> 
		
	</body>
</html>