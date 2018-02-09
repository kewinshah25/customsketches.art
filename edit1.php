<html>
<head>
</head>
<body>

	<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'kew');
	if(! $conn )
	{
		die('Could not connect: ' . mysqli_error());
	}


	$query = "SELECT * FROM login1 ";
	$result = mysqli_query($conn, $query) or die(mysqli_error());

	?>


	<form method="post" action="<?php $_PHP_SELF ?>">
		<table width="400" border="0" cellspacing="1" cellpadding="2">
			<tr>

				<?php 

				while($row = mysqli_fetch_array($result))
				{
					
					$name = $row['name'];
					$sname = $row['sname'];
					$uname = $row['uname'];
					$unameprev = $row['uname'];
					$pword = $row['pword'];
					$cookie_name = "user";
					/*if(!isset($_COOKIE[$cookie_name])) {
						echo "Cookie named '" . $cookie_name . "' is not set!";
					} else {
						echo "Cookie '" . $cookie_name . "' is set!<br>";
						echo "Value is: " . $_COOKIE[$cookie_name];
					}*/	

					if($uname ==  $_COOKIE[$cookie_name]){

						?>


						<td width="100">Name</td>
						<td><input name="name" type="text" value="<?=$name?>"></td>
					</tr>
					<tr>
						<td width="100">Surname</td>
						<td><input name="sname" type="text" value="<?=$sname?>"></td>
					</tr>
					<tr>
						<td width="100"><b>Username</b></td>
						<td><input name="uname" type="text" value="<?=$uname?>"></td>
					</tr>
					<tr>
						<td width="100">Password</td>
						<td><input name="pword" type="text" value="<?=$pword?>"></td>
					</tr>
					<?php break;}} ?>
					<tr>
						<td width="100"> </td>
						<td> </td>
					</tr>
					<tr>
						<td width="100"> </td>
						<td>
							<input name="update" type="submit" id="update" value="Update">
						</td>
					</tr>

					<tr>
						<td width="100"> </td>
						<td>
							<input name="delete" type="submit" id="delete" value="Delete DB">
						</td>
					</tr>
				</table>
			</form>



			<?php

			if(isset($_POST['update']))
			{

				$name = $_POST['name'];
				$sname = $_POST['sname'];
				$uname = $_POST['uname'];
				$pword = $_POST['pword'];
				
				//if($uname ==  $_COOKIE[$cookie_name])
				{
				$sql =  "UPDATE login1 SET uname='$uname', name = '$name', sname = '$sname', pword = '$pword'  WHERE uname = '$unameprev'";

				$retval = mysqli_query( $conn, $sql);
				if(! $retval )
				{
					die('Could not update data: ' . mysqli_error($conn));
				}header("Refresh:0");
				setcookie($cookie_name,$uname,time() + (86400 * 30), "/");
				echo '<script>alert("Updated data successfully")</script>';
			}
			//else echo "Username cannot be changed.";

		}
		else if(isset($_POST['delete']))
		{
			$sql = "DELETE FROM `login1` WHERE uname =  '$_COOKIE[$cookie_name]' ";
			setcookie("user", "", time() - 1);

				$retval = mysqli_query( $conn, $sql);
				if(! $retval )
				{
					die('Could not delete data: ' . mysqli_error($conn));
				}
				echo '<script>alert("Deleted successfully")</script>';
				header('location:login.html');	
		}


		?>
		<h2>Click <a href="index.html">here </a>to go to the Homepage.
	</body>
	</html>