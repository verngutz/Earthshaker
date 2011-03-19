<?

	$hostname = 'localhost';
	$dbname   = 'distribution';
	$username = 'root';
	$password = '';

	$con = mysql_connect($hostname, $username, $password) or die('Connection to host is failed, perhaps the service is down.');
	mysql_select_db($dbname, $con) or die('Database name is missing!');

?>