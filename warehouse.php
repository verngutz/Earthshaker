<?
	include("warehousehead.php");
?>

<html>

	<head>
		<title></title>
		<script type = "text/javascript" src = "dynamictable.jsm"></script>
		<script type = "text/javascript" src = "numericOnly.jsm"></script>
		<script type = "text/javascript">
			
			function initialize()
			{
				updateDateTime();
				setInterval(updateDateTime, 1000);
				updateYearChoice();
				addMonthChoice();
				updateDayChoice();
				addHourChoice();
				addMinuteChoice();
				var tableArray = new Array("deliveryTable", "batchTable");
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
					document.getElementById("hourchoice").selectedIndex = (new Date()).getHours();
					document.getElementById("minutechoice").selectedIndex = (new Date()).getMinutes();
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
			
			function addHourChoice()
			{
				for (var i = 0; i < 24; i++)
				{
					var option = document.createElement("OPTION");
					if((i + "").length == 1)
					{
						option.text = "0" + i;
						option.value = "0" + i;
					}
					else if((i + "").length == 2)
					{
						option.text = i;
						option.value = i;
					}
					document.getElementById("hourchoice").options.add(option);
				}
			}
			
			function addMinuteChoice()
			{
				for (var i = 0; i < 60; i++)
				{
					var option = document.createElement("OPTION");
					if((i + "").length == 1)
					{
						option.text = "0" + i;
						option.value = "0" + i;
					}
					else if((i + "").length == 2)
					{
						option.text = i;
						option.value = i;
					}
					document.getElementById("minutechoice").options.add(option);
				}
			}
			
			function validateDelivery()
			{
				if(document.getElementById("supplier").value == "")
				{
					alert("Supplier field cannot be empty.");
					document.getElementById("supplier").focus();
					return false;
				}
				else
				{
					document.getElementById("submitsupplier").value = document.getElementById("supplier").value;
					var table = document.getElementById("deliveryTable");
					var rowCount = table.rows.length;
					for(var i = 1; i < rowCount; i++) 
					{
						var row = table.rows[i];
						var type = row.cells[1].childNodes[0];
						var cost = row.cells[2].childNodes[0];
						var quantity = row.cells[3].childNodes[0];
						if(cost.value == "")
						{
							alert("Cost field cannot be empty");
							row.cells[2].childNodes[0].focus();
							return false;
						}
						else
						{						
							if(isNaN(cost.value) || parseFloat(cost.value) * 100 != parseInt(parseFloat(cost.value) * 100))
							{
								alert("Invalid cost");
								row.cells[2].childNodes[0].focus();
								return false;
							}
							else
							{
								if(quantity.value == "" || quantity.value == "0")
								{
									alert("Invalid quantity");
									row.cells[3].childNodes[0].focus();
									return false;
								}
								else
								{
									for(var j = i + 1; j < rowCount; j++)
									{
										othertype = table.rows[j].cells[1].childNodes[0];
										if(type.value == othertype.value)
										{
											alert("Each row must be occupied by a unique item type.");
											table.rows[j].cells[1].childNodes[0].focus();
											document.getElementById("submititems1").value = "";
											return false;
										}
									}
									document.getElementById("submititems1").value += type.value +
										"$" + type.options[type.selectedIndex].text + "$" + cost.value + "$" + quantity.value + "$";
								}
							}
						}
					}
					document.getElementById("submityear1").value = document.getElementById("yearchoice").value;
					document.getElementById("submitmonth1").value = document.getElementById("monthchoice").value;
					document.getElementById("submitday1").value = document.getElementById("daychoice").value;
					document.getElementById("submithour1").value = document.getElementById("hourchoice").value;
					document.getElementById("submitminute1").value = document.getElementById("minutechoice").value;
					return true;
				}
			}
			
			function validateIssuance()
			{
				if(document.getElementById("agent").value == "")
				{
					alert("Agent ID# cannot be empty.");
					document.getElementById("agent").focus();
					return false;
				}
				else
				{
					document.getElementById("submitagent").value = document.getElementById("agent").value;
					var table = document.getElementById("batchTable");
					var rowCount = table.rows.length;
					for(var i = 1; i < rowCount; i++) 
					{
						var row = table.rows[i];
						var type = row.cells[1].childNodes[0];
						var quantity = row.cells[3].childNodes[0];
						if(quantity.value == "" || quantity.value == "0")
						{
							alert("Invalid quantity");
							row.cells[3].childNodes[0].focus();
							return false;
						}
						else
						{
							var availablequantity = row.cells[2].childNodes[0];
							if(parseInt(quantity.value) > parseInt(availablequantity.options[availablequantity.selectedIndex].text))
							{
								alert("Requested Quanitity is larger than quantity available in warehouse.");
								row.cells[3].childNodes[0].focus();
								return false;
							}	
							else
							{
								for(var j = i + 1; j < rowCount; j++)
								{
									othertype = table.rows[j].cells[1].childNodes[0];
									if(type.value == othertype.value)
									{
										alert("Each row must be occupied by a unique item type.");
										table.rows[j].cells[1].childNodes[0].focus();
										document.getElementById("submititems2").value = "";
										return false;
									}
								}
								document.getElementById("submititems2").value += type.value +
									"$" + type.options[type.selectedIndex].text + "$" + quantity.value + "$";
							}
						}
					}
					document.getElementById("submityear2").value = document.getElementById("yearchoice").value;
					document.getElementById("submitmonth2").value = document.getElementById("monthchoice").value;
					document.getElementById("submitday2").value = document.getElementById("daychoice").value;
					return true;
				}
			}
			
			
			function updateQuantity(type)
			{
				type.parentNode.parentNode.cells[2].childNodes[0].selectedIndex = type.selectedIndex;
			}
			
		</script>
		
	</head>

	<body onload = "initialize()">
	
		<h2>What would you like to do?</h2>
		<p><input type = "checkbox" id = "manualdt" name = "manualdt" onclick = "updateDateTime()"> 
			Tick to manually set the date and time.
		</p>
		
		<div id = "datetime">
			<p>Date: 
				<select id = "yearchoice" onchange = "updateDayChoice()" name = "yearchoice"></select>
				<select id = "monthchoice" onchange = "updateDayChoice()" name = "monthchoice"></select>
				<select id = "daychoice" name = "daychoice"></select>
			</p>
				
			<p>Time: 
				<select id = "hourchoice" name = "hourchoice"></select> 
				<select id = "minutechoice" name = "minutechoice"></select>
			</p>
		</div>
		
		<hr>
		
		<h3>Accept a New Delivery</h3>
		<form name = "deli" onsubmit = "return validateDelivery();" action = "deliconfirm.php" method = "post">
			<p>Delivered by: <input type = "text" id = "supplier" name = "supplier" value = "Supplier's Name"></p>
			
			<caption>Delivery Items</caption>
			<table id = "deliveryTable">
				<tr>
					<th></th>
					<th>Item Description</th>
					<th>Cost</th>
					<th>Quantity</th>
				</tr>
				<tr>
					<td><input type = "checkbox" name = "checkbox"/></td>
					<td><select name= "itemType"><? getItemsFromDB(); ?></select></td>
					<td><input type = "text" name = "cost"/></td>
					<td><input type = "text" name = "quantity" onkeypress = "return numericOnly(event);"/></td>
				</tr>
			</table>
			
			<input type = "button" value = "Add New Delivery Item" onclick = "addRow('deliveryTable')"/>
			<input type = "button" value = "Delete Selected Delivery Items" onclick = "deleteRow('deliveryTable')"/>
			<br>
			<input type = "hidden" id = "submityear1" name = "submityear1"/>
			<input type = "hidden" id = "submitmonth1" name = "submitmonth1"/>
			<input type = "hidden" id = "submitday1" name = "submitday1"/>
			<input type = "hidden" id = "submithour1" name = "submithour1"/>
			<input type = "hidden" id = "submitminute1" name = "submitminute1"/>
			<input type = "hidden" id = "submitsupplier" name = "submitsupplier"/>
			<input type = "hidden" id = "submititems1" name = "submititems1"/>
			<input type = "submit" value = "Accept Delivery"/>
		</form>
		
		<hr>
		
		<h3>Issue Items to Sales Agent</h3>
		<form name = "issue" onsubmit = "return validateIssuance();" action = "issueconfirm.php" method = "post">
			<p>Issue to Agent ID#: <input type = "text" id = "agent" name = "agent" onkeypress = "return numericOnly(event);"></p>
			<p><input type = "checkbox" name = "newbatch"/>First time issuing to this sales agent this week?</p>
			<caption>Batch Items</caption>
			<table id = "batchTable">
				<tr>
					<th></th>
					<th>Item Description</th>
					<th>Available Quantity</th>
					<th>Quantity to Issue</th>
				</tr>
				<tr>
					<td><input type = "checkbox" name = "checkbox"/></td>
					<td><select name = "itemType" onchange = "updateQuantity(this)"><? getItemsFromDB(); ?></select></td>
					<td><select name = "availablequantity" disabled = "true"><? getWarehouseQuantity(); ?></select></td>
					<td><input type = "text" name = "quantity" onkeypress = "return numericOnly(event);"/></td>
				</tr>
			</table>
			
			<input type = "button" value = "Add New Batch Item" onclick = "addRow('batchTable')"/>
			<input type = "button" value = "Delete Selected Batch Items" onclick = "deleteRow('batchTable')"/>
			<br>
			<input type = "hidden" id = "submityear2" name = "submityear2"/>
			<input type = "hidden" id = "submitmonth2" name = "submitmonth2"/>
			<input type = "hidden" id = "submitday2" name = "submitday2"/>
			<input type = "hidden" id = "submitagent" name = "submitagent"/>
			<input type = "hidden" id = "submititems2" name = "submititems2"/>
			<input type = "submit" value = "Issue Items"/>
		</form>
		
	</body>
	
	<? include ("sitefoot.php"); ?>
	
</html>