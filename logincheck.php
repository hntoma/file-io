<?php
	session_start();
	if(isset($_POST['submit']))
	{
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$utype = $_POST['utype'];
		if ($uname == "" || $password == "") {
			echo "Null submission";
		}
		else
		{
			/*$user = $_SESSION['current_user'];*/
			$myfile = fopen('data.json', 'r');
        	$data = fread($myfile, filesize('data.json'));
        	fclose($myfile);
			$temp = json_decode($data,true);

			for($i = 0; $i < sizeof($temp); $i++) {
				if($temp[$i]['username'] == $uname)
				{
					$user = $temp[$i];
					break;
				}
				
			}

			if(($uname == $user["username"]) && ($password == $user["password"]) && ($utype == $user["type"] )){
				/*$_SESSION['flag'] = true;*/
			if($_POST['remember'] == "remember")
			{

				setcookie('flag', true, time()+(24*60*60), '/');
				setcookie('username', $user['username'], time()+(24*60*60), '/');
				setcookie('password', $user['password'], time()+(24*60*60), '/');

			}
			else{
				setcookie('flag', true, time()+(60*5), '/');
				setcookie('username', $user['username'], time()+(60*5), '/');
				setcookie('password', $user['password'], time()+(60*5), '/');
			}
			header('location: welcome.php');
			}
			else
			{
				echo "Invalid User";
			}

		}
	}
?>