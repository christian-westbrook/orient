<?php
if($_POST['password']==$_POST['confirm']){
	// do something with the request
  //are we making the user automatically i.e. sql insert statement
  //are we sending email to admins to confirm before doing sql insert
  //in either case, there has to somehow be a dept_id (this could be used as a means to confirm or not)
	
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  echo "Email: ".$email."<br>Password: ".$password;

	// Encrypt the provided plaintext password
	$ciphertext = password_hash($plaintext, PASSWORD_DEFAULT);


}
else
{
  echo "your password didnt match, you wack son!";
}
?>
