<?php
	if(!isset($_POST['submit']))
	{
		echo "error! you need to submit the form!";
	}
	$email = $_POST['email'];
	include 'php/database.php';
	$sql  = 'SELECT * FROM USERS WHERE EMAIL= :EMAIL';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':EMAIL', $email, PDO::PARAM_STR);
	if($stmt->execute())
	{
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if($results)
		{
			$subject = "Password reset request";
			$headers = "From: admin@orient.com";
			$body ='
				<!DOCTYPE html>
				<html>
				<head>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script>
				$(document).ready(function(){
				    $("button").click(function(){
					$.post("demo_test_post.asp",
					{
					  name: "Donald Duck",
					  city: "Duckburg"
					},
					function(data,status){
					    alert("Data: " + data + "\nStatus: " + status);
					});
				    });
				});
				</script>
				</head>
				<body>

				<button>Send an HTTP POST request to a page and get the result back</button>

				</body>
				</html>
			';
			mail($email,$subject,$body,$headers);
			header('Location: auth.php');
		}
		else
		{
			echo "you goofed.";
		}
	}
	else
	{
		echo "Unable to access the ORIENT database.";
	}
?>
