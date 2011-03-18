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
		
        <h3>Sell Items</h3>
        <form name = "sell" action = "redirect.php" method = "post">
		<caption>Items to Sell</caption>
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
			<br>
            <input type = "submit" value = "Accept Transaction">
        </form>
        
		<hr>
		
        <h3>Transfer Items</h3>
        <form name = "tran" action = "redirect.php" method = "post">
        	<p>Transfer to Sales Agent with ID#: <input type = "text" name "destagent"></p>
            
            <caption>Items to Transfer:</caption>
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
			<br>
            <input type = "submit" value = "Accept Transfer">
        </form>
        
		<hr>
		
    </body>
	
	<footer>
		© 2011 by Earthshaker
	</footer>
	
</html>