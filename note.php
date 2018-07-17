<?php

// configure the database 
$connection = mysqli_connect('localhost','root','');
if(!$connection){
  exit("database connection failed" .mysqli_error($connection));
}

// connect the database
$select_db=mysqli_select_db($connection,'notes');
if(!$select_db){
  die("database selection failed" .mysqli_error($connection));
}
// receive values from HTML FORM as POST method 
if(isset($_GET['post_url']))
{
  $url=$_GET['post_url'];
  // echo "$url";

// Checking the values are existing in the database or not
$query = "SELECT * FROM `note` WHERE url='$url' ";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
//If the posted values are equal to the database values, then session will be created for the user.
 if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $msg =  $row["msg"] ;
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Notes App</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-image: linear-gradient( 109.6deg,  rgba(253,147,147,1) 11.2%, rgba(250,127,251,1) 91.1% );" >
  <div class="container-fluid" style="text-align: center;" >
    <hr>
    <p>YOUR NOTE:</p>
    <div class="jumbotron">
      <p>
      <?php
        if(isset($_GET['post_url'])){
          echo "$msg"; 
        }
      ?> 
      </p>
    </div>
    <button class="btn btn-default">Home</button><br>
    
  </div>
</body>
</html>