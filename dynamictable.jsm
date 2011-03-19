var EXPORTED_SYMBOLS = ["addRow", "deleteRow"];

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
 
	for(var i = 1; i < rowCount; i++) 
	{
		var row = table.rows[i];
		var checkbox = row.cells[0].childNodes[0];
		if(checkbox != null && checkbox.checked)
		{
			if(rowCount <= 2)
			{
				alert("Cannot delete all the rows.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}