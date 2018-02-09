<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Untitled Document</title>
</head>
<body>
	<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	$name=$_POST['name'];
	$sname=$_POST['sname'];
	if ($username&&$password&&$name&&$sname)
	{



		$connect = mysqli_connect("localhost","root","",'kew');
		$query = mysqli_query($connect,"select * from login1 where uname='$username'");
		$numrows = mysqli_num_rows($query);

		if($numrows!=0)
		{
			while($row = mysqli_fetch_assoc($query))
			{
				$dbusername = $row['uname'];
			}
			if($username==$dbusername)
			{
				echo '<script>alert("Username already taken. Please try again.") 
				window.history.back();
			</script>';
			mysqli_close($connect);
			exit();
			$_SESSION['username']= $dbusername;
		}
	}

	$query = mysqli_query($connect,"INSERT INTO `login1`(`uname`, `pword`,`name`,`sname`) VALUES ('$username','$password','$name','$sname')");
		//$numrows = mysqli_num_rows($query);
	echo ('<h1><b><script> alert("Registered successfully");</script>');

	echo '<script>window.location.href = "login.html";</script>';

	mysqli_close($connect);
}
else echo '<script>alert("Please select all fields") 
	window.history.back();
</script>';

?>

</body>
</html>