<?php
  require("PHPMailer.php");
  require("SMTP.php");
  session_start();
  $accessemail=$_SESSION['emailtoverify'];
  $otp=rand(1000,9999);

   $messages = '<html>
  <head>
  <title>Thanks for Signing up</title>
  </head>
  <body style="width: 430px;height:350px;margin-left:0px;margin-top: 50px;border: 2px solid #000;padding: 30px">
   <header style="background-color: darkred;color:yellow;">
   <h1 style="text-align: center">Thanks for Signing up</h1>
   </header>
   <h4 style="text-align: center">Accesing OTP :  '.$otp.'  <br><br> Dont Share If you Not Aware of this Request </h4>
  </body>
  </html>';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; 
    $mail->IsHTML(true);
    $mail->Username = "gokul.d.2019.cse@rajalakshmi.edu.in";
    $mail->Password = "dekuboi2002";
    $mail->SetFrom("gokul.d.2019.cse@rajalakshmi.edu.in");
    $mail->Subject = "Arigatou ";

    $mail->Body = $messages;
    $mail->AddAddress($accessemail);

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        setcookie("otp", $otp, time() + (86400 * 30), "/");
        echo "<script>window.location.replace('../emailver.php');</script>";
     }


?>

