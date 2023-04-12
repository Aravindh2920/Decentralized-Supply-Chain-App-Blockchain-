<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Supply Chain DAPP</title>
    <link rel="SHORTCUT ICON" href="images/fibble.png" type="image/x-icon" />
    <link rel="ICON" href="images/fibble.png" type="image/ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
    <link href="css/mdbmin.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <?php
  if(isset($_SESSION['role'])){
  ?>
  <body>
    <?php
    include "navbar.php"
    ?>
    <center>
      <div class="customalert">
          <div class="alertcontent">
              <div id="alertText"> &nbsp </div>
              <img id="qrious">
              <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
              <button id="closebutton" class="formbtn"> OK </button>
          </div>
      </div>
    </center>
    <h5 class="ava"> Available product details  </h5>
    <div id="database">
      
    </div>
      
    <div class='box'>
      <div class='wave -one'></div>
      <div class='wave -two'></div>
      <div class='wave -three'></div>
    </div>
  <?php }else{
    include 'redirection.php';
    redirect("index.php");
  } ?>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mdb.min.js"></script>


    <script src="web3.min.js"></script>
    <script src="app.js"></script>

	<!-- QR Code Reader -->
	<script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>

    <!-- Web3 Injection -->
    <script>
      web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));

      // Set the Contract
      var contract = new web3.eth.Contract(contractAbi, contractAddress);
      contract.methods.displayprods().call(function(err, result){
        console.log(err, result)
        
        if(err==null){
          html="<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'><div class='carousel-inner'>";
                for(let i=0;i<result.length;i++)
                {
                  if(i%4==0 && i==0){
                    html+="<div class='carousel-item active'><div class='cards-wrapper'>";
                  }
                  else if(i%4==0 && i!=0){
                    html+="<div class='carousel-item'><div class='cards-wrapper'>";
                  }
                    html+="<div class='card'>";
                    if(result[i][1]=="A")
                    html+="<img class='card-img-top' src='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTR1qa8tE-HE9B4f5oPxCqNYpDUzNLKIDfjD8eeVMkXs9HiL-_i' alt='Card image cap'>";
                    else if(result[i][1]=="B")
                    html+="<img class='card-img-top' src='https://i.pinimg.com/564x/de/7b/8d/de7b8d85939b11f549c026df7a40564b--turmeric-health-turmeric-root.jpg' alt='Card image cap'>";
                    else if(result[i][1]=="C")
                    html+="<img class='card-img-top' src='https://5.imimg.com/data5/CC/II/MY-5308089/turmeric-mother-rhizome-2fmother-rhizome-500x500.jpg' alt='Card image cap'>";
                    html+="<div class='card-body'><h5 class='card-title'>"+result[i][10];
                    html+="</h5><p class='card-text'>Product Grade:"+result[i][1];
                    html+="<br>Product ID: "+result[i][0]+"<br>Type: "+result[i][2];
                    html+="<br>Shelf life (in months): "+result[i][3];
                    html+="<br>Packaging Size (in kgs): "+result[i][4];
                    html+="<br>Quantity (in kgs): "+result[i][5];
                    html+="<br>Manufacturer Name: "+result[i][6];
                    html+="<br>Manufacture date: "+result[i][7];
                    html+="<br>Availability: "+result[i][8];
                    html+="<br>Contact: "+result[i][9];
                    html+="</p></div></div>";
                  if(((i+1)%4==0 && i!=0)|| i==result.length-1){
                    html+="</div></div>";
                  }
                }
                html+="</div><a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'><span class='carousel-control-prev-icon' aria-hidden='true'></span><span class='sr-only'>Previous</span></a><a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'><span class='carousel-control-next-icon' aria-hidden='true'></span><span class='sr-only'>Next</span></a></div>"
                $("#database").html(html);
              }  
          else{
            $("#database").html("<div class='loader'></div>");
          }
        });

    </script>
  </body>
</html>
