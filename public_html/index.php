<?php
include 'header.php';
?>

<head>
<style>

.newdiv{
	align: center;
}
.img-circle{
    border: solid 1px black;
    position: fixed;
    left: 50%;
    top: 70%;
    background-color: white;
    z-index: 100;

    height: 400px;
    margin-top: -200px;

    width: 600px;
    margin-left: -300px;
}
</style>

</head>
<body>

<div class="container">
  <div class="jumbotron">
    <h1>Welcome to ORIENT</h1>
    <p>Resize this responsive page to see the effect!</p> 
  </div>
  <div class="row">
    <div class="col-sm-4">
      <h3>Column 1</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-4">
      <h3>Column 2</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-4">
      <h3>Column 3</h3>        
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
  </div>
</div>

<div class ="newdiv">
	<div class="myimage">
	  <img src="research.jpg" class="img-circle" alt="Logo">
</div>

</body>
</html>
