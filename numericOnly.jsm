var EXPORTED_SYMBOLS = ["numericOnly"];

function numericOnly(e)
{
   var unicode = e.charCode ? e.charCode : e.keyCode;
   return (unicode == 8 || unicode == 9 || (unicode >= 48 && unicode <= 57));
}