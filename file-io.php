<!DOCTYPE HTML>  
<html>
<head>
  <style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
define("filepath", "data.json");
$fname = $lname = $gender = $birthday = $religion = $present = $permanent = $phone = $email = $website = $uname = $psw = "";

$fnameErr = $lnameErr = $genderErr = $birthdayErr = $religionErr = $rpresentErr = $rpermanentErr = $phoneErr = $emailErr = $websiteErr = $unameErr = $pswErr ="";

$flag = false;
$successfulMessage = "";
$errorMessage = "";

if($_SERVER['REQUEST_METHOD'] === "POST") {
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$religion = $_POST['religion'];
$present = $_POST['present'];
$permanent = $_POST['permanent'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$website = $_POST['website'];
$uname = $_POST['username'];
$psw = $_POST['password'];

 if(empty($fname)) {
$firstNameErr = "First name can not be empty!";
$flag = true;
}
if(empty($lname)) {
$lnameErr = "Last name can not be empty!";
$flag = true;
}
if(empty($gender)) {
$genderErr = "Gender is required!";
$flag = true;
}
if(empty($birthday)) {
$birthdayErr = "Birthday is required!";
$flag = true;
}
if(empty($religion)) {
$religionErr = "Religion is required!";
$flag = true;
}
if(empty($present)) {
$presentErr = " ";
$flag = true;
}
if(empty($permanent)) {
$permanentErr = " ";
$flag = true;
}
if(empty($phone)) {
$phoneErr = " ";
$flag = true;
}
if(empty($email)) {
$emailErr = "Email is required!";
$flag = true;
}
if(empty($website)) {
$websiteErr = " ";
$flag = true;
}
if(empty($uname)) {
$unameErr = "Username is required!";
$flag = true;
}
if(empty($psw)) {
$pswErr = "Password is required!";
$flag = true;
}
if(!$flag) {
$existing_data = read();
if(empty($existing_data)) {
$arr1[] = array("fname" => $fname, "lname" => $lname, "gender" => $gender, "birthday" => $birthday, "religion" => $religion, "present" => $present, "permanent" => $permanent, "phone" => $phone, "email" => $email, "website" => $website, "username" => $uname, "password" => $psw);
$result = write(json_encode($arr1));
}

else {
$existing_data_decode[] = json_decode($existing_data);
array_push($existing_data_decode, array("fname" => $fname, "lname" => $lname, "gender" => $gender, "birthday" => $birthday, "religion" => $religion, "present" => $present, "permanent" => $permanent, "phone" => $phone, "email" => $email, "website" => $website, "username" => $uname, "password" => $psw));
write("");
$result = write($existing_data_decode);
}
if($result) {
$successfulMessage = "Successfully Saved!";
}
else {
$errorMessage = "Error while saving!";
}
}
}

 function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
}

 function write($content){
        $file = fopen (filepath, "w+");
        $fw = fwrite ($file,$content . "\n");
        fclose($file);
        return $fw;
    }
 ?>


<h1>Registration Form</h1>
<p><span class="error"> *Must fill in all the fields </span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <fieldset>
    <legend>Basic Information:</legend>
    <br>
   First name:
    <input type="text" name="fname" required>
    <span class="error"><?php echo $fnameErr;?></span>
  <br><br>
Last name: <input type="text" name="lname" required>
 <span class="error"><?php echo $lnameErr;?></span>
  <br><br>
Plese select your gender:<br><br>
  <input type="radio" name="gender" value="female" required>Female <br>
  <input type="radio" name="gender" value="male" required>Male <span class="error"><?php echo $genderErr;?></span><br>
  <input type="radio" name="gender" value="other" required>Other<br>

 <br>
    Birthday:
  <input type="date" id="birthday" name="birthday" required="">
   <span class="error"><?php echo $birthdayErr;?></span>
  <br><br>
   Religion:
<select name="religion" id="religion" required>
  <option value="" >...</option>
  <option value="islam" >Islam</option>
  <option value="hinduism" >Hinduism</option>
  <option value="chirstian" >Chirstian</option>
  <option value="othes">Others</option>
</select>
 <span class="error"><?php echo $religionErr;?></span>
  <br><br>
</select> 
</fieldset> <br>
<fieldset><br>

    <legend>Contact Information:</legend>
       Present address: <textarea name="present" rows="5" cols="40" =""></textarea>
  <br>Permanent address: <textarea name="permanent" rows="5" cols="40" =""></textarea>
<br><br>
   Enter your phone number: <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" >
   <span class="error"><?php echo $phoneErr;?></span> <br> <br>
  Email: <input type="text" name="email" required="">
  <span class="error"><?php echo $emailErr;?></span>
  <br><br>
  Personal Website: <input type="text" name="website" value="" >
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  </fieldset> <br>
  <fieldset>

    <legend>Account Information::</legend><br>
   Username :  <input type="text" placeholder="Enter username" name="username" required> <span class="error"> <?php  echo $unameErr;?></span>
  <br><br>
   Password : <input type="psw" placeholder="Enter password" name="password" required>
   <span class="error"><?php echo $pswErr;?></span><br><br>
    <input type="submit" name="submit" value="Submit">


  </fieldset>

</form>
<br>

 <span style="color: green;"><?php echo $successfulMessage; ?></span>
<span style="color: red;"><?php echo $errorMessage; ?></span>

 <br>

<?php
$readData = read();
$arr1 = explode("\n", $readData);

 echo "<ol>";
for($i = 0; $i < count($arr1) - 1; $i++) {


        
        echo "<li>" . "First Name: " .$temp->fname . 
             "<li>" . "Last Name: " .$temp->lname . 
             "<li>" . "Gender: " .$temp->gender . 
             "<li>" . "Bithday: " .$temp->birthday . 
             "<li>" . "Religion: " .$temp->religion . 
             "<li>" . "Present Address: " .$temp->present . 
             "<li>" . "Permanent Address: " .$temp->permanent . 
             "<li>" . "Phone: " .$temp->phone . 
             "<li>" . "Email: " .$temp->email . 
             "<li>" . "Website: " .$temp->website . 
             "<li>" . "Username: " .$temp->uname . 
             "<li>" . "Password: " .$temp->psw . "</li>";        
        
    }
    echo "</ol>";
 function read() {
$fileName = "data.json";
$fileSize = filesize(filepath);
$fr = "";
if($fileSize > 0) {
$resource = fopen($fileName, "w+");
$fr = fread($resource, $fileSize);
fclose($resource);
return $fr;
}
}
?>
<?php
echo "1. First name is : " . $fname . "<br>";
echo "2. Last name is : " . $lname . "<br>";
echo "3. Gender is : " . $gender . "<br>";
echo "4. Birthday : " . $birthday . "<br>";
echo "5. Religion : " . $religion . "<br>";
echo "6. Present Address : " . $present. "<br>";
echo "7. Permanent Address : " . $permanent. "<br>";
echo "8. Phone : " . $phone . "<br>";
echo "9. E-Mail : " . $email . "<br>";
echo "10. Website : " . $website . "<br>";
echo "11. Username : " . $uname . "<br>";
echo "12. Password : " . $psw . "<br>";
?>
</body>
</html>