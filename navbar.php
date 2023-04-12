<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <?php
          if ( isset( $_SESSION['role'] ) ){
        ?>
        <a class="nav-link" href="displayproduct.php">View Products</a>
        <a class="nav-link" href="checkproduct.php">Check Products</a>
        <?php
          if ( $_SESSION['role']==0 ){
        ?>
        <a class="nav-link" href="addproduct.php">Add Products</a>
        <?php
            }if ( $_SESSION['role']==1 || $_SESSION['role']==0 ){
        ?>
        <a class="nav-link" href="scanshipment.php">Scan Shipment</a>
        <?php
          }
          }
        ?>
        <div class="un"><?php echo $_SESSION['username']; ?></div>
          <div class="md-form my-0">
            <a class="nav-link" href="logout.php" style="padding-left:5px;padding-right:5px;margin-left:0px;"> Logout </a>
          </div>
      </div>
    </div>
  </div>
</nav>
  