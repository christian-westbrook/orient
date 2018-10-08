<?php 

/****************************************************************************
 * System	: Schedu.IO
 * Version	: 1.0
 * File		: ValidationAndSanitization.php
 * Developers	: Nicholas Leonard, Anthony Osagwu, and Christian Westbrook
 * Date Created	: 9/19/18
 * Last Updated : 9/24/18
 * Abstract	: 
 ****************************************************************************/

	/********************************************************************
	 * Class	: ValidationAndSanitization
	 * Abstract	:
	 ********************************************************************/
	class ValidationAndSanitization {

		// =================== | PUBLIC FUNCTIONS | ===============================
		
		/************************************************************
		 * Function	: name()
		 * Input	: $postName - TODO
		 * Process	: 
		 * Output	: 
		 * Abstract	:
		 ************************************************************/
		public function name($postName){
			if(isset($_POST[$postName])){
				$name = $_POST[$postName];
				$clean = $this->sanitizeName($name);
				return $this->validateMatch($clean, $name) ? ['status'=>true, 'message'=>"Valid Name Format"] : ['status'=>false, 'message'=>"Invalid Format"];
			}
		}
		
		/************************************************************
		 * Function	: username()
		 * Input	: $postName - Username string provided by the
		 * 			      user in the username input field
		 * 			      on the authentication page at 
		 * 			      index.php.
		 *
		 * 		  $method   - String denoting whether the user
		 * 		  	      is attempting to sign in with an
		 * 		  	      existing account or register a
		 * 		  	      new account with the system. 
		 * 		  	      Possible accepted values are
		 * 		  	      'signin', 'registration', and
		 * 		  	      'update'.
		 ************************************************************/
		public function username($postName, $method){

			// If the input $postName variable isn't null
			if(isset($_POST[$postName])){

				// Grab the value at key $postName from the $_POST associative array
				// and store this value in the newly defined variable $name. This
				// value represents the username input by the user on the
				// authentication page at index.php.
				$name = $_POST[$postName];

				// Pass the given username into the sanitizeUsername() function, which
				// will return either 1) the same name back, if it is of a valid format
				// for a username, or 2) the boolean value 'false'. The returned value
				// is stored in the newly defined variable $clean.
				$clean = $this->sanitizeUsername($name);

				// Pass the variables $clean and $name into the validateMatch() function,
				// which will compare the two variables and return whether they match or
				// not. If the username input by the user on the authentication page was
				// given in a valid format, then the sanitizeUsername() method will have
				// stored the contents of the string $name into the variable $clean. If
				// this is the case, then this statement will execute its contained code.
				// If the username input by the user on the authentication page was not
				// given in a valid format, then the $clean variable will now contain
				// the boolean value 'false' as a result of the saniitizeUsername()
				// function, and the result of the validateMatch() function will be false,
				// and the if-statement will fail and execute the else-statement.
				if($this->validateMatch($clean, $name)){

					// If the $method variable specifies that the user is registering
					// a new account with our system
					if(strtolower($method) == 'registration'){

						// Return a status and a message. If the given username is
						// available, return a true status and the message
						// "Username Available". If the given username is already
						// taken, return a false status and the message
						// "Username Unavailable".
						return $this->usernameExists($clean) ? ['status'=>false, 'message'=>"Username Unavailable"] : ['status'=>true, 'message'=>"Username Available"];
					}
					elseif(strtolower($method) == 'signin'){
						return $this->usernameExists($clean) ? ['status'=>true, 'message'=>"Valid Username"] : ['status'=>false, 'message'=>"No account is associated with that username."];
					}
					elseif(strtolower($method) == 'update'){
						//Probably won't need this.
					}
					else{
						return ['status'=>false, 'message'=>'Invalid option in $method.'];
					}
				}
				else{
					return ['status'=>false, 'message'=>"Invalid Username Format"];
				}
			}
		}

		public function email($postName, $method){
			if(isset($_POST[$postName])){
				$email = $_POST[$postName];
				$clean = $this->sanitizeEmail($email);
				if($this->validateMatch($clean, $email)){
					if(strtolower($method) == 'registration'){
						return $this->emailExists($clean) ? ['status'=>false, 'message'=>"An account is already associated with that e-mail."] : ['status'=>true, 'message'=>"Valid E-Mail"];
					}elseif (strtolower($method) == 'signin'){
						return $this->emailExists($clean) ? ['status'=>true, 'message'=>"Valid E-Mail"] : ['status'=>false, 'message'=>"No account is associated with that e-mail."];
					}elseif (strtolower($method) == 'update'){
						if($this->validateMatch($email, $_SESSION['EMAIL'])){
							return ['status'=>true, 'message'=>"E-Mail Unchanged"];
						}else{
							return $this->emailExists($clean) ? ['status'=>false, 'message'=>"An account is already associated with that e-mail."] : ['status'=>true, 'message'=>"Valid E-Mail"];
						}
					}else{
						return ['status'=>false, 'message'=>'Invalid option in $method.'];
					}
				}else{
					return ['status'=>false, 'message'=>"Invalid E-Mail Format"];
				}
			}
		}

		public function pass($postName, $method){
			$postIsset = true;
			if(is_array($postName)){
				foreach ($postName as $value => $key){
					if(!isset($_POST[$key])){
						$postIsset = false;
						break;
					}
				}
			}else {
				$postIsset = isset($_POST[$postName]);
			}
			if($postIsset){
				if(strtolower($method) == 'registration'){
					return $this->validatePassword($_POST[$postName]) ? ['status'=>true, 'message'=>"Valid Password"] : ['status'=>false, 'message'=>"Invalid Password - Password must between 6 and 64 characters long."];
				}elseif (strtolower($method) == 'signin') {
					return $this->passwordValid($postName['username'], $postName['password']);
				}else{
					return ['status'=>false, 'message'=>'Invalid option in $method.'];
				}
			}
		}

		public function pass2($pass2, $pass1){
			if(isset($_POST[$pass2]) && isset($_POST[$pass1])){
				if($this->validatePassword($_POST[$pass2])){
					return $this->validateMatch($_POST[$pass2], $_POST[$pass1]) ? ['status'=>true, 'message'=>"Valid Password"] : ['status'=>false, 'message'=>"Passwords Do Not Match"];
				}else{
					return ['status'=>false, 'message'=>"Invalid Password - Password must between 6 and 64 characters long."];
				}
			}
		}

		public function number($postName){
			if(isset($_POST[$postName])){
				return is_numeric($_POST[$postName]) ? ['status'=>true, 'message'=>"Valid Integer"] : ['status'=>false, 'message'=>"Invalid Integer Format."];
			}
		}

		public function dropdown($postName, $array, $validMessage, $invalidMessage){
			if(isset($_POST[$postName])){
				return in_array($_POST[$postName], $array) ? ['status'=>true, 'message'=>$validMessage] : ['status'=>false, 'message'=>$invalidMessage];
			}
		}

		public function checkbox($postName, $validMessage, $invalidMessage){
			return isset($_POST[$postName]) ? ['status'=>true, 'message'=>$validMessage] : ['status'=>false, 'message'=>$invalidMessage];
		}

		public function passwordValid($email, $password){
			include('database.php');
			$sql = "SELECT * FROM USERS WHERE EMAIL='" . $email . "' AND PASSWORD='" . $password . "'";
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if (isset($results)) {
				return ['status'=>true, 'message'=>"Valid Password"];
			}
			else {
				return ['status'=>false, 'message'=>"Invalid Password"];
			}
			/*if(isset($_POST[$email]) && isset($_POST[$password])){
				$postdata = http_build_query(['email'=>$_POST[$email],'pass'=>$_POST[$password]]);
				$opts = ['http'=>['method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded','content'=>$postdata]];
				$context  = stream_context_create($opts);
				$url = ($_SERVER['HTTP_HOST'] == "localhost") ? "http://localhost/functions/checkPass.php" : "https://" . $_SERVER['HTTP_HOST'] . "/functions/checkPass.php";
				$json = json_decode(file_get_contents($url, false, $context), true);
				return $json['valid']==true ? ['status'=>true, 'message'=>"Valid Password"] : ['status'=>false, 'message'=>"Incorrect Password - <a href='/?page=resetPassword&email=".$_POST[$email]."' class='text-danger font-weight-bold'>Reset Password</a>"];
			}*/
		}

		public function emailExists($email){
			include('database.php');

			$sql = "SELECT * FROM USERS WHERE EMAIL='" . $email . "'";
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return isset($results);

			/*$json = json_decode(file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/functions/checkEmail.php?email=$email"), true);
			return $json["exist"];*/
		}

		public function usernameExists($username){
			include('database.php');

			$sql = "SELECT * FROM USERS WHERE USERNAME='" . $username . "'";
			$stmt = $pdo->query($sql);
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return isset($results);
			/*$json = json_decode(file_get_contents("http://" . $_SERVER['HTTP_HOST'] . "/functions/checkEmail.php?email=$email"), true);
			return $json["exist"];*/
		}
		
		// ========================= | SANITATION | =========================
		private function sanitizeName($name){
			$name = trim(preg_replace('/\s\s+/', ' ', $name));
			return (preg_match('/^[a-z1-9_-]+$/i', $name)) ? $name : false;
		}

		private function sanitizeUsername($name){
			$cleanName = trim(preg_replace('/\s\s+/', '', $name));
			return preg_match('/^[a-z1-9_-]+$/i', $name) ? $name : false;
		}

		private function sanitizeEmail($email){
			$email = trim(preg_replace('/\s\s+/', ' ', $email));
			return (preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $email)) ? $email : false;
		}

		// ========================= | VALIDATION | =========================
		private function validateLength($input, $min, $max){
			$length = strlen($input);
			return ($length < $min || $length > $max) ? false : true;
		}

		private function validateMatch($value1, $value2){
			return ($value1 == $value2);
		}

		private function validateEmail($email){
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		private function validateName($name){
			return $this->validateLength($name, 1, 255);
		}

		private function validatePassword($password){
			return $this->validateLength($password, 6, 64);
		}

		private function validateCheckbox($check){
			return isset($check);
		}

		private function isNumber($number){
			return is_number($check);
		}

		private function validateDropdown($value, $array){
			return in_array($values, $array);
		}

		// ========================= | DISPLAY | =========================
		function feedbackClass($boolean){echo $boolean ? 'is-valid' : 'is-invalid';}
		function feedbackMessage($boolean, $message){echo $boolean ? "<div class='valid-feedback'>$message</div>" : "<div class='invalid-feedback'>$message</div>";}
	}
?>
