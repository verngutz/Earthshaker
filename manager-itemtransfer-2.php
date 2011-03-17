<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("SELECT t.transferno as 'transferno', t.transferdate as 'transferdate', t.sourcebatch as 'sourcebatch', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname' FROM transfer t, salesagent s, batch b WHERE transfer.transferno=$_POST['input1'] AND transfer.sourcebatch=batch.batchno AND batch.agentid=salesagent.agentid LIMIT 1");

		echo "<table border='1'>
		<tr>
		<th>Transfer No.</th>
		<th>Date</th>
		<th>Source Batch</th>
		<th>Source Name</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['transferno'] . "</td>";
		  echo "<td>" . $row['transferdate'] . "</td>";
		  echo "<td>" . $row['sourcebatch'] . "</td>";
		  echo "<td>" . $row['agentname'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		$result3 = mysql_query("SELECT t.desbatch as 'desbatch', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname' FROM transfer t, salesagent s, batch b WHERE transfer.transferno=$_POST['input1'] AND transfer.desbatch=batch.batchno AND batch.agentid=salesagent.agentid LIMIT 1");
		
		echo "<table border='1'>
		<tr>
		<th>Destination Batch</th>
		<th>Destination Name</th>
		</tr>";

		while($row = mysql_fetch_array($result3))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['desbatch'] . "</td>";
		  echo "<td>" . $row['agentname'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		
		$result2 = mysql_query("SELECT t.itemcode as 'itemcode', i.description as 'desc', t.quantity as 'quant', i.srp as 'srp' FROM item i, transfer t WHERE transfer.transferno=$_POST['input1'] AND transfer.itemcode=item.itemcode");
		
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