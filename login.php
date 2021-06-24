<html>
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
            $all_donor = json_decode($data,true);

            for($i = 0; $i < sizeof($all_donor); $i++) {
                if($all_donor[$i]['username'] == $uname)
                {
                    $user = $all_donor[$i];
                    break;
                }
                
            }

            if(($uname == $user['username']) && ($password == $user['password']) && ($utype == $user['type'] )){
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


<body>     
 <center>
 <form method="POST" action="logincheck.php" >
             
<h1 align ="center"><strong>LOGIN</strong></h1>
<strong>User Name</strong><br>
<input type="text" name="uname" value="" required><br><br>
<strong>Password </strong><br>
<input type="password" name="password" value="" required><br><br>
<input type="submit" name="submit" value="Login"><br><hr>
</form>
</center>
</body></html>