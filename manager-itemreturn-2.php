<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("SELECT b.batchno as 'batchno', r.returndate as 'returndate', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname', c.clientname as 'clientname', i.itemcode as 'itemcode', i.description as 'desc', ib.quantity as 'quant'
			FROM batch b, salesagent s, client c, itemreturn r, item i, itemxbatch ib
			WHERE batch.agentid=salesagent.agentid AND salesagent.clientid=client.clientid AND batch.batchno=itemreturn.batchno AND itemxbatch.batchno=batch.batchno AND item.itemcode=itemxbatch.itemcode AND batch.batchno=itemreturn.batchno");

		echo "<table border='1'>
		<tr>
		<th>Batch</th>
		<th>Date</th>
		<th>Agent</th>
		<th>Client</th>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>		
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['batchno'] . "</td>";
		  echo "<td>" . $row['returndate'] . "</td>";
		  echo "<td>" . $row['agentname'] . "</td>";
		  echo "<td>" . $row['clientname'] . "</td>";
		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		mysql_close($con);
		?> 
		
	</body>
</html>