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
if(isset($_POST['msg']) )
{
  $msg=$_POST['msg'];
  $url = uniqid();
  // echo "$msg";
  // echo "$url";

  // insert values into database
  $query="INSERT INTO note (msg,url) Values ('$msg','$url')";
  $result = mysqli_query($connection, $query);
  // if($result)
  // {
  //   echo " success";
  // }
  // else
  // {
  //   echo "failed";
  // }
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
    <h2>Notes App</h2>
    <h5>This is a note sharing application where you can submit a note and App will generate a short url for that note.</h5>
    <div class="jumbotron">
      <form action="index.php" method="POST">
        <div class="form-group">
          <label for="comment">Note:</label>
          <textarea  class="form-control" rows="8" name="msg" id="comment" required></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div><br>

    <div class="well">GENERATED URL:
      <input type="text" value=" <?php if (isset($_POST['msg'])) {
      echo 'http://www.notesapp.com/?post_url=' .$url. ''; 
      }
      ?>" id="myInput">
    <button onclick="myFunction()">Copy URL</button>
    </div>
    
    <hr>
  </div>
  <script>
    function myFunction() {
      var copyText = document.getElementById("myInput");
      copyText.select();
      document.execCommand("copy");
      alert("Copied the text: " + copyText.value);
    }
  </script>
</body>
</html>