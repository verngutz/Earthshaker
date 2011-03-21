<?
	include("managerhead.php");
?>

<html>

	<head>
		<title>Item Issuance Reports</title>
	</head>
	
	<body>

		<?
		
			$result = mysql_query("
			
			SELECT b.batchno as 'batchno', iss.issuedate as 'batchdate', concat(s.agentlastname, ', ', s.agentfirstname) as 'agentname',
			c.clientname as 'clientname', concat(st.stafflastname,' ,',st.stafffirstname) as 'issuer', i.itemcode as 'itemcode',
			i.description as 'desc', iss.quantity as 'quant', i.srp as 'srp'
			FROM batch b, salesagent s, client c, item i, staff st, issuance iss
			WHERE b.batchno=iss.batchno AND s.agentid=iss.agentid AND c.clientid=s.clientid AND i.itemcode=iss.itemcode AND st.staffid=iss.staffid
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

		?> 
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>