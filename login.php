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
	if($_POST ['action'] == 'Submit')
	{
		$username=$_POST['username'];
		$username=trim($username);
		$password=$_POST['password'];
		$password=trim($password);
		if ($username&&$password)
		{
			$connect = mysqli_connect("localhost","root","",'kew');

			$query = mysqli_query($connect,"select * from login1 where uname='$username'");
			$numrows = mysqli_num_rows($query);

			if($numrows!=0)
			{
				while($row = mysqli_fetch_assoc($query))
				{
					$dbusername = $row['uname'];
					$dbpassword = $row['pword'];
					$dbname = $row['name'];
					$dbsname = $row['sname'];
				}
				if($username==$dbusername&&$password==$dbpassword)
				{


					$cookie_name = "user";
					$cookie_value = $username;

					$cookie_name1 = "nameofu";
					$cookie_value1 = $dbname;


					$cookie_sname = "snameofu";
					$cookie_value2 = $dbsname;

					
					setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = day
					setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = day
					setcookie($cookie_sname, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = day

					echo '<script> 
					//alert("Login successful")</script>';
					
					/*if(!isset($_COOKIE[$cookie_name])) {
						echo "Cookie named '" . $cookie_name . "' is not set!";
					} else {
						echo "Cookie '" . $cookie_name . "' is set!<br>";
						echo "Value is: " . $_COOKIE[$cookie_name];
					}*/
					
					echo '<script>window.location.href = "index.html";</script>';

					$_SESSION['username']= $dbusername;
				}
				else
					echo '<script>alert("Incorrect password.") 
					window.history.back();
					</script>';
		}
		else
			echo '<script>alert("Username does not exist.") 
					window.history.back();
					</script>';;
	}
	else
		echo '<script>alert("Please enter username and password") 
					window.history.back();
					</script>';
	
}
else if($_POST ['action'] == 'Register'){
	header('Location: register.html');


}
else {
//invalid action!
}
?>
</body>
</html>