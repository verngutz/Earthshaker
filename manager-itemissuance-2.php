<html>
	<body>

		<?php
		include("managerhead.php");
		
		
		$result = mysql_query("
		
		SELECT b.batchno as 'batchno', i.issuedate as 'batchdate', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname', c.clientname as 'clientname', concat(st.stafflastname,' ,',st.stafffirstname) as 'issuer', i.itemcode as 'itemcode', i.description as 'desc', ib.quantity as 'quant', i.srp as 'srp'
		FROM batch b, salesagent s, client c, item i, itemxbatch ib, staff st, issuance is
		WHERE b.agentid=s.agentid AND s.clientid=c.clientid AND ib.batchno=b.batchno AND i.itemcode=is.itemcode AND st.staffid=b.staffid AND b.batchno=is.batchno
		ORDER BY b.batchno
		
		");

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