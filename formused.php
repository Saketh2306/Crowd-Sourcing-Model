
<?php
session_start();
$_SESSION['message1'] = "";
$dbhost = 'localhost';
$username1 = 'root';
$password = '';
$dbname = 'innodb';
$con = mysqli_connect("$dbhost" , "$username1" , "$password");
if(!$con)
{
	die("Cannot connect".mqlsql_error());
}
$dbconnect = mysqli_select_db($con , $dbname);
if(!$dbconnect)
{
	die("Cannot connect to db".mqlsql_error());
}
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if(isset($_POST['signup']))
	{
	if($_POST['userpassword'] == $_POST['userconfirmpassword'])
	{
		$useremail = $_POST['useremail'];
		$username = $_POST['username'];
		$userpassword =$_POST['userpassword'];
		$usercontact = $_POST['usercontact'];
		$hash = md5( rand(0,1000) );
		$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
		$query = "INSERT INTO users (user_id,user_name,user_password,user_contact,hash) VALUES ('$useremail','$username','$userpassword',$usercontact,'$hash')";
		$result = mysqli_query($con,$query);
		if($result)
		{
			$_SESSION['message1'] = "Registration Successful. Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.";
			$to      = $email; // Send email to our user
			$subject = 'Signup | Verification'; // Give the email a subject
			$message = '

			Thanks for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

			------------------------
			Username: '.$useremail.'
			Password: '.$userpassword.'
			------------------------

			Please click this link to activate your account:
			http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

'; // Our message above including the link

$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
		}
		else
		{
			$_SESSION['message1'] = "User Could not be added";
		}

	}
	else
	{
		$_SESSION['message1'] = "Entered passwords donot match";
	}
    }
}
?>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Nunito:400,700'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link rel="stylesheet" href="form.css" type="text/css">
<body  a link = "white" vlink = "white">
	<div align = center>
<a href = "form.php" link = "white">User</a>

<a href = "expert_registration.php" link = "white">Expert</a>

<a href = "institution_registration.php" link = "white">Institute</a>

</div>
</body>
<div id="frm-cvr">
			<div class="cl-wh" id="f-mlb">Create an account</div>
			<div class="alert alert-error"><?= $_SESSION['message1']?></div>
			<form action ="form.php" method = "POST" autocomplete="off" enctype="multipart/form-data">
				<label class="cl-wh f-lb">Name</label>
				<div class="f-i-bx b3 mrg3b">
					<div class="tb">
						<div class="td icn"><i class="material-icons">person</i></div>
						<div class="td prt"><input type="text" name ="username" required></div>
					</div>
				</div>
				<label class="cl-wh f-lb">Email address</label>
				<div class="f-i-bx b3 mrg3b">
					<div class="tb">
						<div class="td icn"><i class="material-icons">email</i></div>
						<div class="td prt"><input type="email" name = "useremail" required ></div>
					</div>
				</div>
				<label class="cl-wh f-lb">Password</label>
				<div class="f-i-bx b3">
					<div class="tb">
						<div class="td icn"><i class="material-icons">lock</i></div>
						<div class="td prt"><input type="password" name = "userpassword" required></div>
					</div>
				</div>
				<br>
				<label class="cl-wh f-lb">Confirm Password</label>
				<div class="f-i-bx b3">
					<div class="tb">
						<div class="td icn"><i class="material-icons">lock</i></div>
						<div class="td prt"><input type="password" name = "userconfirmpassword" required></div>
					</div>
				</div>
				<br>
				<label class="cl-wh f-lb">Contact</label>
				<div class="f-i-bx b3 mrg3b">
					<div class="tb">
						<div class="td icn"><i class="material-icons">phone</i></div>
						<div class="td prt"><input type="text" name = "usercontact" required></div>
					</div>
				</div>
				<div id="s-btn" class="mrg25t"><input type="submit" value="Sign up" class="b3" name = 'signup'></div>
				<div id="tc-bx">If you are a registered user <a href="login.php" target = "_top">Signin!</a>.</div>

			</form>
		</div>
