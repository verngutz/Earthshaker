<?
	include("managerhead.php");
?>

<html>

	<head>
		<title>Item Transfer Reports</title>
	</head>
	
	<body>

		<?
		
			$result = mysql_query("
			
			SELECT t.transferno as 'transferno', t.transferdate as 'transferdate', t.sourcebatch as 'sourcebatch',
			concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname',
			t.desbatch as 'desbatch', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname2',
			t.itemcode as 'itemcode', i.description as 'desc', t.quantity as 'quant', i.srp as 'srp'
			FROM transfer t, salesagent s, batch b, item i, salesagent ss, batch bb
			WHERE t.sourcebatch=b.batchno AND b.agentid=s.agentid
			AND t.desbatch=bb.batchno AND bb.agentid=ss.agentid AND t.itemcode=i.itemcode
			
			");
			
			echo "<table border='1'>
			<tr>
			<th>Transfer No.</th>
			<th>Date</th>
			<th>Source Batch</th>
			<th>Source Name</th>
			<th>Destination Batch</th>
			<th>Destination Name</th>	
			<th>Item</th>
			<th>Description</th>
			<th>Qty</th>
			<th>SRP</th>		
			</tr>";

			while($row = mysql_fetch_array($result))
			  {
			  echo "<tr>";
			  echo "<td>" . $row['transferno'] . "</td>";
			  echo "<td>" . $row['transferdate'] . "</td>";
			  echo "<td>" . $row['sourcebatch'] . "</td>";
			  echo "<td>" . $row['agentname'] . "</td>";
			  echo "<td>" . $row['desbatch'] . "</td>";
			  echo "<td>" . $row['agentname2'] . "</td>";	
			  echo "<td>" . $row['itemcode'] . "</td>";
			  echo "<td>" . $row['desc'] . "</td>";
			  echo "<td>" . $row['quant'] . "</td>";
			  echo "<td>" . $row['srp'] . "</td>";
			  echo "</tr>";
			  }
			echo "</table>";
		
		?> 
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>