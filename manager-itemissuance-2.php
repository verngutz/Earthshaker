<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("SELECT b.batchno as 'batchno', b.batchdate as 'batchdate', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname', c.clientname as 'clientname', b.issuer as 'issuer' FROM batch b, salesagent s, client c WHERE batch.batchno=$_POST['input1'] AND batch.agentid=salesagent.agentid AND salesagent.clientid=client.clientid LIMIT 1");

		echo "<table border='1'>
		<tr>
		<th>Batch</th>
		<th>Date</th>
		<th>Agent</th>
		<th>Client</th>
		<th>Issuer</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['batchno'] . "</td>";
		  echo "<td>" . $row['batchdate'] . "</td>";
		  echo "<td>" . $row['agentname'] . "</td>";
		  echo "<td>" . $row['clientname'] . "</td>";
		  echo "<td>" . $row['issuer'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		$result2 = mysql_query("SELECT i.itemcode as 'itemcode', i.description as 'desc', ib.quantity as 'quant', i.srp as 'srp' FROM item i, itemxbatch ib, batch b WHERE batch.batchno=$_POST['input1'] AND itemxbatch.batchno=batch.batchno AND item.itemcode=itemxbatch.itemcode");
		
		echo "<table border='1'>
		<tr>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>
		<th>SRP</th>
		</tr>";
		
		while($row = mysql_fetch_array($result2))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "<td>" . $row['srp'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		
		mysql_close($con);
		?> 
		
	</body>
</html>