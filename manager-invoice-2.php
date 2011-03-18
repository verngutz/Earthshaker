<html>
	<body>

		<?php
		$con = mysql_connect("localhost", "root", "root") or die('Could not connect: ' . mysql_error());
		mysql_select_db("distribution", $con);
		$result = mysql_query("SELECT i.invoiceno as 'invoiceno',i.invoicedate as 'invoicedate', concat(s.agentlastname,', ',s.agentfirstname) as 'agentname', c.clientname as 'clientname', it.itemcode as 'itemcode', it.description as 'desc', ii.quantity as 'quant', it.srp as 'srp', d.amount as 'discount', (ii.quantity*it.srp*(100-d.amount)/100) as 'saleprice'
							FROM item it, discount d, itemxinvoice ii, salesagent s, invoice i, client c
							WHERE invoice.agentid=salesagent.agentid AND salesagent.clientid=client.clientid AND salesagent.clientid=discount.clientid AND salesagent.agentid=invoice.agentid AND invoice.invoiceno=itemxinvoice.invoiceno AND itemxinvoice.itemcode=item.itemcode
							ORDER BY invoice.invoiceno"
							);

		echo "<table border='1'>
		<tr>
		<th>Invoice No.</th>
		<th>Date</th>
		<th>Agent</th>
		<th>Client</th>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>
		<th>SRP</th>
		<th>Discount</th>
		<th>Sale Price</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['invoiceno'] . "</td>";
		  echo "<td>" . $row['invoicedate'] . "</td>";
		  echo "<td>" . $row['agentname'] . "</td>";
		  echo "<td>" . $row['clientname'] . "</td>";
  		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "<td>" . $row['srp'] . "</td>";
		  echo "<td>" . $row['discount'] . "</td>";
		  echo "<td>" . $row['saleprice'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
	
		mysql_close($con);
		?> 
		
	</body>
</html>