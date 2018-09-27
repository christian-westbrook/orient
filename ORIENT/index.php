<?php

/**************************************************************************
 * System	: Schedu.IO
 * Version	: 1.0
 * File		: index.php
 * Developers	: Nicholas Leonard, Anthony Osagwu, Christian Westbrook
 * Date Created	: 9/19/18
 * Last Updated	: 9/24/18
 * Abstract	: This file contains the home page of the Schedu.IO web
 *                system. The home page displays an authentication interface
 *                to the user, who can choose to register with the site or to
 *                log in with an existing account. Authentication provides
 *                access to Schedu.IO, a website whose purpose is to serve
 *                UAFS course data to students wanting to plan their
 *                school schedules with the help of a user-friendly
 *                interface. 
 **************************************************************************/

// Intiates Session 
session_start();
$_SESSION["logIn"] = "false";

// Include these PHP files
include('view/header.php');				// Defines the header of each page
include('controller/ValidationAndSanitization.php');    // Used to validate input authentication data and to sanitize input registration form data

// Define the variable 'vas' as a new ValidationAndSanitation object
$vas = new ValidationAndSanitization();

// ====================== | CONTROL STRUCTURES ========================

// If the key 'signin-signin' has a value that is not null in the $_POST associative array...
// Executes when the 'Sign In' button is clicked
if(isset($_POST['signin-signin'])){

	// Define the 'vasSignin' variable
	$vasSignin;

	// Define the 'vasSigninUser variable as the result of the username() method in the ValidationAndSanitization class, passing in the
	// 'signin-user' variable, which is retrieved from the username input field, and the 'signin' variable, 
	$vasSigninUser = $vas->username('signin-user', 'signin');
	$vasSigninEmail = $vas->email('signin-user', 'signin');
	$vasSigninPass = $vas->pass(['username'=>"signin-user", 'password'=>"signin-pass"], "signin");


	if($vasSigninUser['status'] && !$vasSigninEmail['status']){
		$vasSignin = ['status'=>true, 'message'=>"Valid Username."];
	}
	elseif(!$vasSigninUser['status'] && $vasSigninEmail['status']){
		$vasSignin = ['status'=>true, 'message'=>"Valid E-Mail."];
	}
	else{
		$vasSignin = ['status'=>false, 'message'=>"No account associated with that E-Mail or Username."];
	}

	if($vasSignin['status'] && $vasSigninPass['status']){
		include('database.php');
		$sql="SELECT * FROM USERS WHERE USERNAME='" . $_POST['signin-user']  . "' AND PASSWORD='" . $_POST['signin-pass'] . "'";
		$stmt = $pdo->query($sql);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);	

		if($results === FALSE) {
			$vasSignin = ['status'=>false, 'message'=>"Invalid login credentials."];
		}
		else
		{
			$username = $results[0]['USERNAME'];
			$pw = $results[0]['PASSWORD'];

			if($username == $_POST['signin-user'] && $pw == $_POST['signin-pass']) {
				$_SESSION["logIn"] = "true";
				header('Location: home.php'); 	// Redirect browser to home.php
			}
		}
	}
}

// If the key 'reg-reg' has a value that is not null in the $_POST associative array...
// Executes when the 'Register' button is clicked
if(isset($_POST['reg-reg'])){
	$vasRegFname = $vas->name('reg-fname');
	$vasRegLname = $vas->name('reg-lname');
	$vasRegName = ($vasRegFname['status'] && $vasRegLname['status']) ? ['status'=>true, 'message'=>'Valid Name Format'] : ['status'=>true, 'message'=>'Invalid Name Format'];
	$vasRegUsername = $vas->username('reg-username', 'signin');
	$vasRegEmail = $vas->email("reg-email", "registration");
	$vasRegPassword = $vas->pass("reg-password", "registration");
	$vasRegPassword2 = $vas->pass2("reg-password2", "reg-password");

	if($vasRegFname['status'] && $vasRegLname['status'] && $vasRegUsername['status'] && $vasRegEmail['status'] && $vasRegPassword['status'] && $vasRegPassword2['status']){
		header('Location: home.php');
	}
}
?>

<!-- Authentication/Registration Card Outer Container -->
<!-- Contains a mid-level container that contains an inner container that contains the card -->
<div class='container mt-lg-5 mt-md-3 mt-2'>

	<!-- Authentication/Registration Card Mid-Level Container -->
	<!-- Contains another inner container that contains the card -->
	<div class='row justify-content-center'>
		
		<!-- Authentication/Registration Card Inner Container -->
		<!-- Contains the card -->
		<div class='col-sm-12 col-md-7'>
			
			<!-- Authentication/Registration Card -->
			<div class='card shadow-sm'>

				<!-- Card Headers (Sign In & Register) -->
				<div class="card-header nav nav-tabs nav-fill pb-0">
					<a class="nav-item nav-link active" href="#home-signin" id="home-signin-tab" data-toggle="tab" aria-controls="home-signin" aria-selected="true">Sign In</a>
					<a class="nav-item nav-link" href="#home-register" id="home-register-tab" data-toggle="tab" aria-controls="home-register" aria-selected="false">Register</a>
				</div>
				<!-- End Card Headers -->

				<!-- Card Body -->
				<form class='card-body tab-content' action='<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>' method='post'>

					<!-- Sign In Form -->
					<!-- Activated when the card header 'Sign In' is selected -->
					<div class="tab-pane fade show active" id="home-signin" role="tabpanel" aria-labelledby="home-signin-tab">

						<!-- Username -->
	          				<div class="input-group mb-2">
	            					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-person"></span>
								</span>
							</div>

	            					<input type="text" class="form-control <?php isset($vasSignin) ? $vas->feedbackClass($vasSignin['status']) : ""; ?>" name="signin-user" placeholder="Username or E-Mail" <?php echo isset($_POST['signin-user']) ? 'value="'.$_POST['signin-user'].'"' : ""; ?>/>
							
							<?php isset($vasSignin) ? $vas->feedbackMessage($vasSignin['status'], $vasSignin['message']) : ""; ?>
						</div>
						<!-- End Username -->

						<!-- Password -->
	        	  			<div class="input-group mb-2">
	            					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-lock-locked"></span>
								</span>
							</div>

							<input type="password" class="form-control <?php isset($vasSigninPass) ? $vas->feedbackClass($vasSigninPass['status']) : ""; ?>" name="signin-pass" placeholder="Password" />

							<?php isset($vasSignin) ? $vas->feedbackMessage($vasSigninPass['status'], $vasSigninPass['message']) : ""; ?>
	          				</div>
						<!-- End Password -->

						<!-- Sign In Button -->
						<div class="form-group mb-0">
							<input class="btn btn-block btn-primary" type="submit" name="signin-signin" value="Sign In">
						</div>
						<!-- End Sign In Button -->
					</div>
					<!-- End Sign In Form -->



					<!-- Registration Form -->
					<!-- Activated when the card header 'Register' is selected -->
					<div class="tab-pane fade" id="home-register" role="tabpanel" aria-labelledby="home-register-tab">

						<!-- Firstname & Lastname -->
						<div class="input-group mb-2">
		    					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-person"></span>
								</span>
							</div>
	
							<input type="text" class="form-control <?php isset($vasRegName) ? $vas->feedbackClass($vasRegName['status']) : ""; ?>" name="reg-fname" placeholder="Firstname" <?php echo isset($_POST['reg-fname']) ? 'value="'.$_POST['reg-fname'].'"' : ""; ?>/>

							<input type="text" class="form-control <?php isset($vasRegName) ? $vas->feedbackClass($vasRegName['status']) : ""; ?>" name="reg-lname" placeholder="Lastname" <?php echo isset($_POST['reg-lname']) ? 'value="'.$_POST['reg-lname'].'"' : ""; ?>>

							<?php isset($vasRegName) ? $vas->feedbackMessage($vasRegName['status'], $vasRegName['message']) : ""; ?>
	          				</div>
						<!-- End Firstname & Lastname -->

						<!-- Username -->
					        <div class="input-group mb-2">
	            					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-person"></span>
								</span>
							</div>

							<input type="text" class="form-control <?php isset($vasRegUsername) ? $vas->feedbackClass($vasRegUsername['status']) : ""; ?>" name="reg-username" placeholder="Username" <?php echo isset($_POST['reg-username']) ? 'value="'.$_POST['reg-username'].'"' : ""; ?>/>

							<?php isset($vasRegUsername) ? $vas->feedbackMessage($vasRegUsername['status'], $vasRegUsername['message']) : ""; ?>
						</div>
						<!-- End Username -->

						<!-- E-Mail -->
	          				<div class="input-group mb-2">
	            					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-envelope-closed"></span>
								</span>
							</div>

							<input type="text" class="form-control <?php isset($vasRegEmail) ? $vas->feedbackClass($vasRegEmail['status']) : ""; ?>" name="reg-email" placeholder="E-Mail" <?php echo isset($_POST['reg-email']) ? 'value="'.$_POST['reg-email'].'"' : ""; ?>/>

							<?php isset($vasRegEmail) ? $vas->feedbackMessage($vasRegEmail['status'], $vasRegEmail['message']) : ""; ?>
						</div>
						<!-- End E-Mail -->

						<!-- Password -->
	          				<div class="input-group mb-2">
	            					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-lock-locked"></span>
								</span>
							</div>

							<input type="password" class="form-control <?php isset($vasRegPassword) ? $vas->feedbackClass($vasRegPassword['status']) : ""; ?>" name="reg-password" placeholder="Password"/>

							<?php isset($vasRegPassword2) ? $vas->feedbackMessage($vasRegPassword2['status'], $vasRegPassword2['message']) : ""; ?>
					          </div>
						  <!-- End Password -->

						  <!-- Password Again -->
					          <div class="input-group mb-2">
	            					<div class="input-group-prepend">
								<span class="input-group-text">
									<span class="oi oi-lock-locked"></span>
								</span>
							</div>

						        <input type="password" class="form-control <?php isset($vasRegPassword2) ? $vas->feedbackClass($vasRegPassword2['status']) : ""; ?>" name="reg-password2" placeholder="Password Again">
							<?php isset($vasRegPassword2) ? $vas->feedbackMessage($vasRegPassword2['status'], $vasRegPassword2['message']) : ""; ?>
	          				</div>
						<!-- End Password Again -->

						<!-- Register Button -->
						<div class="form-group mb-0">
							<input class="btn btn-block btn-primary" type="submit" name="reg-reg" value="Register"/>
						</div>
						<!-- End Register Button -->
					</div>
					<!-- End Registration Form -->
				</form>
				<!-- End Card Body -->

			</div>
			<!-- End Authentication/Registration Card -->

		</div>
		<!-- End Authentication/Registration Card Inner Container -->

	</div>
	<!-- End Authentication/Registration Card Mid-Level Container -->

</div>
<!-- End Authentication/Registration Card Outer Container -->

<!-- Defines the footer of each page -->
<?php include('view/footer.php'); ?>
