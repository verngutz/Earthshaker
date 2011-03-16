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
				hideTemplateRows(tableArray);
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
				
		</script>
	</head>

	<body onload = "initialize()">
		<h1>Warehouse Staff</h1>
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
			
		<h3>Accept a New Delivery</h3>
		<form name = "deli" action = "redirect.php" method = "post">
			<p>Delivered by: <input type = "text" name = "supplier" value = "Supplier's Name"></p>
			<p>Received by: <input type = "text" name = "supplier" value = "Staff's Name"></p>
			
			<caption>Delivery Items</caption>
			<table id = "deliveryTable">
				<th>
					<td>Item Type</td>
					<td>Cost</td>
					<td>Quantity</td>
				</th>
				<tr>
					<td><input type = "checkbox" name = "checkbox"/></td>
					<td><select name= "itemType"></select></td>
					<td><input type = "text" name = "cost" onkeypress = "return numericOnly(event);"/></td>
					<td><input type = "text" name = "quantity" onkeypress = "return numericOnly(event);"/></td>
				</tr>
			</table>
			
			<input type = "button" value = "Add New Delivery Item" onclick = "addRow('deliveryTable')"/>
			<input type = "button" value = "Delete Selected Delivery Items" onclick = "deleteRow('deliveryTable')"/>
			<br>
			<input type = "submit" value = "Accept Delivery">
		</form>
		
		<h3>Issue Items to Sales Agent</h3>
		<form name = "issue" action = "redirect.php" method = "post">
			<p>Issued to: <input type = "text" name = "supplier" value = "Sales Agent's Name"></p>
			<p>Issued by: <input type = "text" name = "supplier" value = "Staff's Name"></p>
			
			<caption>Batch Items</caption>
			<table id = "batchTable">
				<th>
					<td>Item Type</td>
					<td>Quantity</td>
				</th>
				<tr>
					<td><input type = "checkbox" name = "checkbox"/></td>
					<td><select name= "itemType"></select></td>
					<td><input type = "text" name = "quantity" onkeypress = "return numericOnly(event);"/></td>
				</tr>
			</table>
			
			<input type = "button" value = "Add New Batch Item" onclick = "addRow('batchTable')"/>
			<input type = "button" value = "Delete Selected Batch Items" onclick = "deleteRow('batchTable')"/>
			<br>
			<input type = "submit" value = "Issue Items">
		</form>
	
		<p id = "debug">
		</p>
	</body>
	
</html>