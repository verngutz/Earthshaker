var EXPORTED_SYMBOLS = ["numericOnly"];

function numericOnly(e)
{
	var unicode = e.which ? e.which : e.keyCode;
	return (unicode == 8 || unicode == 9 || unicode == 37 || unicode == 39 || (unicode >= 48 && unicode <= 57));
}