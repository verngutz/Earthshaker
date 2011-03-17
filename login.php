<?
	include('config.inc');
	$id = $_POST["userID"];
	$_SESSION['userID'] = $id;

	$result = mysql_query("SELECT * FROM staff WHERE staffid = '" . $id . "'") or die ("Error: " . mysql_error()); 
	if (mysql_num_rows($result) == 1)
	{
		$_SESSION['type'] = "staff";
		header("Location: warehouse.php");
	}	
	else
	{
		$result = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'") or die ("Error: " . mysql_error());
		if (mysql_num_rows($result) == 1)
		{
			$_SESSION['type'] = "salesagent";
			header("Location: seller.php");
		}
		else
		{
			$result = mysql_query("SELECT * FROM manager WHERE managerid = '" . $id . "'") or die ("Error: " . mysql_error());
			if (mysql_num_rows($result) == 1)
			{
				$_SESSION['type'] = "manager";
				header("Location: manager.php");
			}
			else
			{
				$_SESSION['error'] = "Invalid ID";
				header("Location: index.php");
			}
		}
	}
		
?>

