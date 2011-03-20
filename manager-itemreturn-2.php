<html>
	<body>

		<?php
		include("managerhead.php");
		$result = mysql_query("
		
		select b.batchno as 'batchno', r.returndate as 'returndate', concat(s.agentlastname,' ,',s.agentfirstname) as
		'agentname', c.clientname as 'clientname',i.itemcode, i.description as 'desc', ib.quantity as 'quant'
		from batch b,salesagent s, client c, itemreturn r, item i, itemxbatch ib
		 where b.agentid=s.agentid and s.clientid=c.clientid and b.batchno=r.batchno and ib.batchno=b.batchno and
		 i.itemcode=ib.itemcode and b.batchno=r.batchno order by r.batchno
		
		");

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