<?php

/**************************************************************************
 * System	  : Optimized Research Interest Network
 * Version	  : Prototype System I
 * File		  : index.php
 * Developers : Christian Westbrook, Nicholas Leonard
 *
 * Abstract	  : This file presents the home page of the ORIENT web system.
 *              The page displays an authentication interface to the user,
 *              who can choose to register with the site or to log in with
 *              an existing account. Authentication provides access to
 *              ORIENT, a social network designed with researchers in mind.
 **************************************************************************/

// Links the style page index-styles. TODO This needs to be tested and adapted for ORIENT.
//$css = ['index-styles'];

// Includes the header. This file needs to be tested and adapted for ORIENT.
include('header.php');

// This file validates and sanitizes user data. This file needs to be tested and adapted
// for ORIENT.
include('ValidationAndSanitization.php');

// This file needs to be tested and adapted for ORIENT. 
include('userController.php');

// Declare variables
$vas = new ValidationAndSanitization();
$uc = new userController();


// Executes when the 'Sign In' button is pressed.
// If the POST key 'signin-signin' is set,
if(isset($_POST['signin-signin']))
{
	// Variable for checking if either the username or email is valid.
	$vasSignin;
	
	// This variable is set to the result of the username() function in
	// the ValidationAndSanitization class.
	$vasSigninUser = $vas->username('signin-user', 'signin');
	
	// This variable is set to the result of the email() function in the
	// ValidationAndSanitization class.
	$vasSigninEmail = $vas->email('signin-user', 'signin');
	
	// This variable is set to the result of the pass() function in the
	// ValidationAndSanitization class.
	$vasSigninPass = $vas->pass(['username'=>"signin-user", 'password'=>"signin-pass"], "signin");
	
	// Checks if either the username or the email is valid
	// If the status key of $vasSigninUser is set to true and of $vasSigninEmail is set to false, 
	if($vasSigninUser['status'] && !$vasSigninEmail['status'])
	{
		// Set the status key of the $vasSignin variable to true.
		$vasSignin = ['status'=>true, 'message'=>"Valid Username."];
	}
	// Else if the status key of $vasSigninUser is set to false and of $vasSigninEmail is set to true,
	elseif(!$vasSigninUser['status'] && $vasSigninEmail['status'])
	{
		// Set the status key of the $vasSigninVaraible to true.
		$vasSignin = ['status'=>true, 'message'=>"Valid E-Mail."];
	}
	else
	{
		// Set the status key of the $vasSigninVariable to false.
		$vasSignin = ['status'=>false, 'message'=>"No account associated with that E-Mail or Username."];
	}
	
	// If both a valid username/email and valid password have been entered,
	if($vasSignin['status'] && $vasSigninPass['status'])
	{
		// This variable is assigned the result of the signin() function in the userController class.
		$userInfo = $uc->signin($_POST['signin-user'], $_POST['signin-pass']);
		
		// If the $userInfo variable isn't set to false,
		if($userInfo != false)
		{
			// Call the createSession() function in the header, passing in the $userInfo.
			createSession($userInfo);
			
			// Redirect to profile.php
			header('Location: profile.php');
		}
	}
}

// Executes when the 'Register' button is presssed.
// If the POST key 'reg-reg' is set,
if(isset($_POST['reg-reg']))
{
	// This variable is set to the result of the name() function in the ValidationAndSanitization class.
	$vasRegFname = $vas->name('reg-fname');
	
	// This variable is set to  the result of the name() functionin the ValidationAndSanitization class.
	$vasRegLname = $vas->name('reg-lname');
	k k n
	// 
	$vasRegName = ($vasRegFname['status'] && $vasRegLname['status']) ? ['status'=>true, 'message'=>'Valid Name Format'] : ['status'=>true, 'message'=>'Invalid Name Format'];
	$vasRegUsername = $vas->username('reg-username', 'signin');
	$vasRegEmail = $vas->email("reg-email", "registration");
	$vasRegPassword = $vas->pass("reg-password", "registration");
	$vasRegPassword2 = $vas->pass2("reg-password2", "reg-password");
	//When all fields are correct
	if($vasRegFname['status'] && $vasRegLname['status'] && $vasRegUsername['status'] && $vasRegEmail['status'] && $vasRegPassword['status'] && $vasRegPassword2['status']){
		$userInfo = $uc->register($_POST['reg-fname'], $_POST['reg-lname'], $_POST['reg-email'], $_POST['reg-username'], $_POST['reg-password'], $_POST['reg-password2']);
		var_dump($userInfo);
		/*if($userInfo != false){
			createSession($userInfo);
			location('home.php');
		}*/
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
<?php include('footer.php'); ?>
