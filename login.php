<?
	include('config.inc');
	session_start();
	$id = $_POST['userID'];
	$_SESSION['userID'] = $id;

	$result = mysql_query("SELECT * FROM staff WHERE staffid = '" . $id . "'");
	if (mysql_num_rows($result) == 1)
	{
		$_SESSION['type'] = "staff";
		header("Location: warehouse.php");
	}	
	else
	{
		$result = mysql_query("SELECT * FROM  salesagent WHERE agentid = '" . $id . "'");
		if (mysql_num_rows($result) == 1)
		{
			$_SESSION['type'] = "salesagent";
			header("Location: seller.php");
		}
		else
		{
			$result = mysql_query("SELECT * FROM manager WHERE managerid = '" . $id . "'");
			if (mysql_num_rows($result) == 1)
			{
				$_SESSION['type'] = "manager";
				header("Location: manager.php");
			}
			else
			{
				unset($_SESSION['type']);
				$_SESSION['error'] = "Invalid ID";
				header("Location: index.php");
			}
		}
	}
		
?>

