<?
	include("sellerhead.php");
?>

<html>

	<head>
    	<title></title>
        <script type = "text/javascript" src = "dynamictable.jsm"></script>
        <script type = "text/javascript" src = "numericOnly.jsm"></script>
        <script type = "text/javascript">
			
			function initializeMazingerZ()
			{
				updateDateTime();
				setInterval(updateDateTime, 1000);
				updateYearChoice();
				addMonthChoice();
				updateDayChoice();
				var tableArray = new Array("sellTable", "transferTable");
			}
			
			function updateDateTime()
			{
				if(document.getElementById("manualdt").checked)
				{
					document.getElementById("datetime").style.visibility = 'visible';
					document.getElementById("datetime").style.display = 'block';
				}
				else
				{
					document.getElementById("datetime").style.visibility = 'hidden';
					document.getElementById("datetime").style.display = 'none';
					updateYearChoice();
					document.getElementById("yearchoice").selectedIndex = 0;
					document.getElementById("monthchoice").selectedIndex = (new Date()).getMonth();
					updateDayChoice();
					document.getElementById("daychoice").selectedIndex = (new Date()).getDate() - 1;
				}
			}
			
			function updateYearChoice()
			{
				for(var i = document.getElementById("yearchoice").options.length - 1; i >= 0; i--)
					document.getElementById("yearchoice").remove(i);
					
				var i = (new Date()).getFullYear();
				for (var c = 0; c < 25; c++)
				{
					var option = document.createElement("OPTION");
					option.text = i;
					option.value = i;
					document.getElementById("yearchoice").options.add(option);
					i--;
				}
			}
			
			function addMonthChoice()
			{
				var months = new Array();
				months[1] =	"January";
				months[2] =	"February";
				months[3] =	"March";
				months[4] =	"April";
				months[5] =	"May";
				months[6] =	"June";
				months[7] =	"July";
				months[8] =	"August";
				months[9] =	"September";
				months[10] = "October";
				months[11] = "November";
				months[12] = "December";
				
				for (var i = 1; i < months.length; i++)
				{
					var option = document.createElement("OPTION");
					option.text = months[i];
					if((i + "").length == 1)
						option.value = "0" + i;
					else if((i + "").length == 2)
						option.value = i;
					document.getElementById("monthchoice").options.add(option);
				}
			}
			
			function updateDayChoice()
			{
				for(var i = document.getElementById("daychoice").options.length - 1; i >= 0; i--)
					document.getElementById("daychoice").remove(i);
					
				for (var i = 1; i <= 28; i++)
				{
					var option = document.createElement("OPTION");
					option.text = i;
					if((i + "").length == 1)
						option.value = "0" + i;
					else if((i + "").length == 2)
						option.value = i;
					document.getElementById("daychoice").options.add(option);
				}
				
				var month = document.getElementById("monthchoice").selectedIndex + 1;
				var yearchoice = document.getElementById("yearchoice");
				var year = yearchoice.options[yearchoice.selectedIndex].value;

				if((month == 2 && year % 4 == 0) || month != 2)
				{
					var option29 = document.createElement("OPTION");
					option29.text = 29;
					option29.value = 29;
					document.getElementById("daychoice").options.add(option29);
				}
				if(month != 2)
				{
					var option30 = document.createElement("OPTION");
					option30.text = 30;
					option30.value = 30;
					document.getElementById("daychoice").options.add(option30);
					if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12)
					{
						var option31 = document.createElement("OPTION");
						option31.text = 31;
						option31.value = 31;
						document.getElementById("daychoice").options.add(option31);
					}
				}
			}
			
			function validateInvoice()
			{
				if(document.getElementById("client").innerHTML == "None")
				{
					alert("No client to sell items to");
					return false;
				}
				else
				{
					var batchTable = document.getElementById("batchTable");
					var batchTableRowCount = batchTable.rows.length;
					
					var table = document.getElementById("sellTable");
					var rowCount = table.rows.length;
					for(var i = 1; i < rowCount; i++) 
					{
						var row = table.rows[i];
						var typenode = row.cells[1].childNodes[0];
						var type = typenode.options[typenode.selectedIndex].text;
						var quantity = row.cells[2].childNodes[0];
						
						
						if(quantity.value == "" || quantity.value == "0")
						{
							alert("Invalid quantity");
							row.cells[2].childNodes[0].focus();
							document.getElementById("submititems1").value = "";
							return false;
						}
						else
						{
							var quantityavailable = 0;
							for(var j = 0; j < batchTableRowCount; j++)
							{
								if(batchTable.rows[j].cells[0].innerHTML == typenode.value)
								{
									quantityavailable = parseInt(batchTable.rows[j].cells[2].innerHTML);
									break;
								}
							}
							if (parseInt(quantity.value) > quantityavailable)
							{
								alert("Requested quantity is larger than quantity in hand for item: " + type + ".");
								row.cells[2].childNodes[0].focus();
								document.getElementById("submititems1").value = "";
								return false;
							}
							else
							{
								for(var k = i + 1; k < rowCount; k++)
								{
									othertype = table.rows[k].cells[1].childNodes[0];
									if(typenode.value == othertype.value)
									{
										alert("Each row must be occupied by a unique item type.");
										table.rows[k].cells[1].childNodes[0].focus();
										document.getElementById("submititems1").value = "";
										return false;
									}
								}
								document.getElementById("submititems1").value += typenode.value +
									"$" + type + "$" + quantity.value + "$";
							}
						}
					}
					document.getElementById("submityear1").value = document.getElementById("yearchoice").value;
					document.getElementById("submitmonth1").value = document.getElementById("monthchoice").value;
					document.getElementById("submitday1").value = document.getElementById("daychoice").value;
					return true;
				}
			}
			
			function validateTransfer()
			{
				return true;
			}
			
			function validateReturn()
			{
				var batchTable = document.getElementById("batchTable");
				var batchTableRowCount = batchTable.rows.length;

				var hasItems = false;
				for(var i = 1; i < batchTableRowCount; i++)
				{
					hasItems = true;
					var row = batchTable.rows[i];
					var itemcode = row.cells[0].innerHTML;
					var itemdesc = row.cells[1].innerHTML;
					var quantity = row.cells[2].innerHTML;
					document.getElementById("submititems3").value += itemcode + "$" + itemdesc + "$" + quantity + "$";
					alert(itemcode);
					alert(itemdesc);
					alert(quantity);
				}
				if(!hasItems)
				{
					alert("No items to return");
					document.getElementById("submititems1").value = "";
					return false;
				}
				else
				{
					if(confirm("Are you sure you want to return your entire batch of items?"))
					{
						document.getElementById("submityear3").value = document.getElementById("yearchoice").value;
						document.getElementById("submitmonth3").value = document.getElementById("monthchoice").value;
						document.getElementById("submitday3").value = document.getElementById("daychoice").value;
						return true;
					}
					else
					{
						document.getElementById("submititems3").value = "";
						return false;
					}
				}
			}
			
		</script>
    </head>
    
    <body onload = "initializeMazingerZ()">
        
		<h2>What would you like to do?</h2>
    	<p><input type = "checkbox" id = "manualdt" name = "manualdt" onclick = "updateDateTime()"> 
			Tick to manually set the date.
		</p>
		
		<div id = "datetime">
			<p>Date: 
				<select id = "yearchoice" onchange = "updateDayChoice()" name = "yearchoice"></select>
				<select id = "monthchoice" onchange = "updateDayChoice()" name = "monthchoice"></select>
				<select id = "daychoice" name = "daychoice"></select>
			</p>
		</div>
        
		<hr>
		
		<h3>Assigned Client</h3>
			<p id = "client"><? getClient($_SESSION['userID']); ?></p>
		
		<hr>
		
		<h3>Items in Hand</h3>
			<form name = "return" action = "processreturn.php" onsubmit = "return validateReturn();" method = "post">
				<input type = "hidden" id = "submityear3" name = "submityear3"/>
				<input type = "hidden" id = "submitmonth3" name = "submitmonth3"/>
				<input type = "hidden" id = "submitday3" name = "submitday3"/>
				<input type = "hidden" id = "submititems3" name = "submititems3"/>
				<input type = "submit" value = "Return Current Batch"/>
			</form>
			<? getBatchFromDB($_SESSION['userID']); ?>
		<hr>
		
        <h3>Submit a Sales Invoice</h3>
        <form name = "sell" action = "sellconfirm.php" method = "post" onsubmit = "return validateInvoice();">
		<caption>Items Sold</caption>
            <table id = "sellTable">
            	<tr>
					<th></th>
                	<th>Item Type</th>
                    <th>Quantity</th>
                </tr>
            	<tr>
					<td><input type = "checkbox" name = "checkbox"/></td>
                	<td><select name = "itemType"><? getItemsFromDB(); ?></select></td>
					<td><input type = "text" name = "quantity" onkeypress = "return numericOnly(event);"/></td>
                </tr>
            </table>
			
			<input type = "button" value = "Add New Transaction Item" onclick = "addRow('sellTable')"/>
			<input type = "button" value = "Delete Selected Transaction Items" onclick = "deleteRow('sellTable')"/>
			<input type = "hidden" id = "submityear1" name = "submityear1"/>
			<input type = "hidden" id = "submitmonth1" name = "submitmonth1"/>
			<input type = "hidden" id = "submitday1" name = "submitday1"/>
			<input type = "hidden" id = "submititems1" name = "submititems1"/>
			<br>
            <input type = "submit" value = "Accept Transaction">
        </form>
        
		<hr>
		
        <h3>Transfer Items</h3>
        <form name = "tran" action = "redirect.php" method = "post" onsubmit = "return validateTransfer();">
        	<p>Transfer to Sales Agent with ID#: <input type = "text" name "destagent"></p>
            
            <caption>Items to Transfer</caption>
            <table id = "transferTable">
            	<tr>
					<th></th>
                	<th>Item Type</th>
                    <th>Quantity</th>
                </tr>
            	<tr>
					<td><input type = "checkbox" name = "checkbox"/></td>
                	<td><select name = "itemType"><? getItemsFromDB(); ?></select></td>
					<td><input type = "text" name = "quantity" onkeypress = "return numericOnly(event);"/></td>
                </tr>
            </table>
			
			<input type = "button" value = "Add New Transfer Item" onclick = "addRow('transferTable')"/>
			<input type = "button" value = "Delete Selected Transfer Items" onclick = "deleteRow('transferTable')"/>
			<input type = "hidden" id = "submityear2" name = "submityear2"/>
			<input type = "hidden" id = "submitmonth2" name = "submitmonth2"/>
			<input type = "hidden" id = "submitday2" name = "submitday2"/>
			<input type = "hidden" id = "submititems2" name = "submititems2"/>
			<br>
            <input type = "submit" value = "Accept Transfer">
        </form>
		
    </body>
	
	<? include ("sitefoot.php"); ?>
	
</html>