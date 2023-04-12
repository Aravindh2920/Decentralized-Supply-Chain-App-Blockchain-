<?php
session_start();
include 'connectdb.php';


$accessemail=$_SESSION['emailtoverify'];

$fotp=$_COOKIE['otp'];
$numlength = strlen((string)$fotp);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/fibble.png" type="image/ico" />

    <title>Supply chain - Decentralized Application</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">  

  </head>
  <body>
  <div class="ever" >
      <h4> Enter the verification code</h4>
            <form style="margin-top: 30px; margin-bottom: 30px;" action="" method="POST">
            <input type="number" class="forminput" name="votp" required>
            <input type="hidden" name="sotp" value="<?php  echo $fotp; ?>" >
            <input type="hidden" name="slength" value="<?php  echo $numlength; ?>" >
            <button class="formbtn" name="verifyotp" type="submit">Submit</button>
            </form>
      </div>
  <?php 
if(isset($_POST['verifyotp']))
{
  $votp=$_POST['votp'];
  $sotp=$_POST['sotp'];
  $slength=$_POST['slength'];

// for General 

  if($votp==$sotp)
  {
    $conn=openConnection();
    $email = $_SESSION['emailtoverify'];
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    $pw = $_SESSION['password'];
    $stmt = $conn->prepare("INSERT INTO users (email ,username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss",$email ,$username ,$pw ,$role);
    $stmt->execute();

    include 'redirection.php';
    redirect('checkproduct.php');
  }
  else
  {
      echo "<script>alert('Verification Faild');</script>";
  }

}

  ?>
    
</body>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</html>