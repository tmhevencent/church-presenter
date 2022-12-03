<?php 
include('config.php');
?><title>ACK</title><?
//Checks if there is a login cookie
if(isset($_COOKIE['ID_your_site'])){ //if there is, it logs you in and directes you to the members page
 	$check = mysqli_query($conect, "SELECT * FROM users WHERE username = '$username'")or die(mysql_error());

 	while($info = mysqli_fetch_array( $check )){
 		if ($pass != $info['password']){}
 		else{
 			header("Location: index.php");
		}
 	}
 }

 //if the login form is submitted 
 if (isset($_POST['submit'])) {

	// makes sure they filled it in
 	if(!$_POST['username']){
 		die('You did not fill in a username.');
 	}
 	if(!$_POST['pass']){
 		die('You did not fill in a password.');
 	}

 	// checks it against the database
 	if (!get_magic_quotes_gpc()){
 		$_POST['email'] = addslashes($_POST['email']);
 	}

 	$check = mysqli_query($conect, "SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());

 //Gives error if user dosen't exist
 $check2 = mysqli_num_rows($check);
 if ($check2 == 0){
	die('<div align="center"><p>That user does not exist in our database.<br /><br />If you think this is wrong <a href="index.php">try again</a>.</div>');
}

while($info = mysqli_fetch_array( $check )){
	$_POST['pass'] = stripslashes($_POST['pass']);
 	$info['password'] = stripslashes($info['password']);
 	$_POST['pass'] = md5($_POST['pass']);

	//gives error if the password is wrong
 	if ($_POST['pass'] != $info['password']){
 		die('<div align="center">Incorrect password, please <a href="index.php">try again</a>.</div>');
 	}
	
	else{ // if login is ok then we add a cookie 
		$_POST['username'] = stripslashes($_POST['username']); 
		$_SESSION['username']= $_POST['username'];
 
		//then redirect them to the members area 
		header("Location: members.php"); 
	}
}
}
else{
// if they are not logged in 
?>
<style>
body {

    background: #91a716;

    display: flex;

    justify-content: center;

    align-items: center;

    height: 100vh;

    flex-direction: column;

}

*{

    font-family: cursive;

    box-sizing: padding-box;

}

form {

    width: 50%;

    border: 3px solid rgb(177, 142, 142);

    padding: 20px;

    background: rgb(251, 248, 248);

    border-radius: 20px;

}

h2 {

    text-align: center;

    margin-bottom: 40px;

}

input {

    display: block;

    border: 2px solid #ccc;

    width: 95%;

    padding: 10px;

    margin: 10px auto;

    border-radius: 5px;

}

label {

    color: #888;

    font-size: 18px;

    padding: 10px;

}

button {

    float: right;

    background: rgb(35, 174, 202);

    padding: 10px 15px;

    color: #fff;

    border-radius: 5px;

    margin-right: 10px;

    border: none;

}

button:hover{

    opacity: .10;

}

.error {

   background: #F2DEDE;

   color: #0c0101;

   padding: 10px;

   width: 95%;

   border-radius: 5px;

   margin: 20px auto;

}

h1 {

    text-align: center;

    color: rgb(134, 3, 3);

}

a {

    float: right;

    background: rgb(183, 225, 233);

    padding: 10px 15px;

    color: #fff;

    border-radius: 10px;

    margin-right: 10px;

    border: none;

    text-decoration: none;

}

a:hover{

    opacity: .7;

}
</style>
 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 

 <table border="0" align="center"> 

 <tr><td colspan=2><h1>ACK</h1></td></tr> 

 <tr><td>Username:</td><td> 

 <input type="text" name="username" maxlength="40"> 

 </td></tr> 

 <tr><td>Password:</td><td> 

 <input type="password" name="pass" maxlength="50"> 

 </td></tr> 

 <tr><td> <td align="right"> 

 <input type="submit" name="submit" value="Login"> 

 </td></tr> 

 </table> 

 </form> 

 <?php 
 }
 ?> 
