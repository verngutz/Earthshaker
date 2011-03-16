var EXPORTED_SYMBOLS = ["hideTemplateRows", "addRow", "deleteRow"];

function hideTemplateRows(tableID)
{
	for(var i = 0; i < tableID.length; i++)
	{
		var table = document.getElementById(tableID[i]);
		table.rows[0].style.visibility = 'hidden';
		table.rows[0].style.display = 'none';
		table.rows[1].style.visibility = 'hidden';
		table.rows[1].style.display = 'none';
	}
}

function addRow(tableID) 
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	var colCount = table.rows[1].cells.length;
	
	table.rows[0].style.visibility = 'visible';
	table.rows[0].style.display = 'table-row';
	
	for(var i = 0; i < colCount; i++) 
	{
		var newcell = row.insertCell(i);
		newcell.innerHTML = table.rows[1].cells[i].innerHTML;
		
		switch(newcell.childNodes[0].type) 
		{
			case "text":
				newcell.childNodes[0].value = "";
				break;
			case "checkbox":
				newcell.childNodes[0].checked = false;
				break;
			case "select-one":
				newcell.childNodes[0].selectedIndex = 0;
				break;
		}
		
	}
}

function deleteRow(tableID) 
{
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;

	for(var i = 2; i < rowCount; i++) 
	{
		var row = table.rows[i];
		var checkbox = row.cells[0].childNodes[0];
		if(checkbox != null && checkbox.checked) 
		{
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
	
	if(rowCount <= 2)
	{
		table.rows[0].style.visibility = 'hidden';
		table.rows[0].style.display = 'none';
	}
	
}