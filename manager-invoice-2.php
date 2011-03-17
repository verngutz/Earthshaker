<html>
	<body>

		<?php
		
		$result = mysql_query("SELECT i.invoiceno as 'invoiceno',i.invoicedate as 'invoicedate', i.agentid as 'agentid', s.clientid as 'clientid' FROM invoice i, salesagent s WHERE invoiceno=$_POST["input1"] and i.agentid=s.agentid LIMIT 1");

		echo "<table border='1'>
		<tr>
		<th>Invoice No.</th>
		<th>Date</th>
		<th>Agent</th>
		<th>Client</th>
		</tr>";

		while($row = mysql_fetch_array($result))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['invoiceno'] . "</td>";
		  echo "<td>" . $row['invoicedate'] . "</td>";
		  echo "<td>" . $row['agentid'] . "</td>";
		  echo "<td>" . $row['clientid'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		echo "<br>";
		
		$result2 = mysql_query("SELECT i.itemcode as 'itemcode', i.description as 'desc', ii.quantity as 'quant', i.srp as 'srp', d.amount as 'discount', (ii.quantity*i.srp*(100-d.amount)/100) as 'saleprice' FROM item i, discount d, itemxinvoice ii, salesagent sa, invoice iv WHERE itemxinvoice.invoiceno=$_POST["input1"] AND salesagent.clientid=discount.clientid AND salesagent.agentid=invoice.agentid AND invoice.invoiceno=itemxinvoice.invoiceno AND itemxinvoice.itemcode=item.itemcode);
		
		echo "<table border='1'>
		<tr>
		<th>Item</th>
		<th>Description</th>
		<th>Qty</th>
		<th>SRP</th>
		<th>Discount</th>
		<th>Sale Price</th>
		</tr>";
		
		while($row = mysql_fetch_array($result2))
		  {
		  echo "<tr>";
		  echo "<td>" . $row['itemcode'] . "</td>";
		  echo "<td>" . $row['desc'] . "</td>";
		  echo "<td>" . $row['quant'] . "</td>";
		  echo "<td>" . $row['srp'] . "</td>";
		  echo "<td>" . $row['discount'] . "</td>";
		  echo "<td>" . $row['saleprice'] . "</td>";
		  echo "</tr>";
		  }
		echo "</table>";
		
		
		mysql_close($con);
		?> 
		
	</body>
</html>