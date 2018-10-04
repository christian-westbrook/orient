

<div>
	<!-- Profile Picture -->
	<div style="float:left">
		<img src="picture.jpg" alt="Profile Picture" style="float:left,width:250px;height:250px;padding:15px 15px 15px 100px;">
	</div>

	<!-- Name and Title -->
	<div style="padding:50px 15px 15px 15px;">
		<h2 style="text-align:center"> Anthony Todaro </h2>
		<h2 style="text-align:center"> Information Technology </h2>
		
		<button id="editProfile" type="button" style="float:right;">Edit</button>
	</div>
		
		<div>
			<!-- Profile Information -->
			<div style="padding:90px 15px 15px 15px;text-align:center;span:45%;float:left">
				<h3>First Name: </h3>
				<h3>Last Name: </h3>
				<h3>Title: </h3>
				<h3>Department: </h3>
				<h3>Email: </h3>
				<h3>Phone Number: </h3>
			</div>
			
			<!-- Data for the profile -->
			<div id="profileData" style="padding:90px 15px 15px 15px;span:45%;text-align:center">
				<h3>Anthony</h3>
				<h3>Todaro</h3>
				<h3>Student</h3>
				<h3>Information Technology</h3>
				<h3>rtodar00@g.uafs.edu</h3>
				<h3>479-651-0987</h3>
			</div>
		</div>
	
</div>

<div>

	<!-- When the edit button is clicked, this script will change the profileData div to show text boxes so that
		 users can change their information. -->
	<script>
	
		document.getElementById('editProfile').onclick = function() {
			document.getElementById('profileData').innerHTML = 'This is a test';
		}
	
	</script>

</div>
