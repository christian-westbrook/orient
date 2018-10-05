
<!-- CSS -->
<style>
.myForm {
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 0.8em;
width: 30em;
padding: 1em;
border: 1px solid #ccc;
}

.myForm * {
box-sizing: border-box;
}

.myForm fieldset {
border: none;
padding: 0;
}

.myForm legend,
.myForm label {
padding: 0;
font-weight: bold;
}

.myForm label.choice {
font-size: 0.9em;
font-weight: normal;
}

.myForm label {
text-align: left;
display: block;
}

.myForm input[type="text"],
.myForm select,
.myForm textarea {
float: right;
width: 60%;
border: 1px solid #ccc;
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 0.9em;
padding: 0.3em;
}

.myForm input[type="file"] {
float: right;
width: 60%;
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 0.9em;
padding: 0.3em;
}

.myForm button {
padding: 1em;
border-radius: 0.5em;
background: #eee;
border: none;
font-weight: bold;
margin-left: 40%;
margin-top: 1.8em;
}

.myForm button:hover {
background: #ccc;
cursor: pointer;
}
</style>

</head>
<body>

<form class="myForm" method="get">

<p>
<label>First Name
<input type="text" name="firstName" required>
</label> 
</p>

<p>
<label>Last Name 
<input type="text" name="lastName">
</label>
</p>

<p>
<label>Title 
<input type="text" name="title">
</label>
</p>

<p>
<label>Department 
<input type="text" name="department">
</label>
</p>

<p>
<label>Email 
<input type="text" name="email">
</label>
</p>

<p>
<label>Phone Number 
<input type="text" name="phoneNumber">
</label>
</p>

<p>
<label>Profile Picture
<input type="file" name="profilePicture">
</label>
</p>

<p><button>Save</button></p>

</form>

</body>