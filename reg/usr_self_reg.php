<?php
include("../include.php");
?>

<!doctype html>
<html>
<head>
<?php get_head(); ?>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<div style="background-color:black; margin:0">
	<p style="font-size:36px; color:white; text-align:center"><strong style="color:rgba(255,54,58,1.00)">TEDx</strong> <strong style="color:rgba(255,255,255,1.00)">WIS</strong> REGISTRATION 	</p>
</div>
<?php
if(isset($_GET['success'])){
echo '
<div class="panel" style="background-color:green">
YOU HAVE SUCCESFULLY REGISTERED, YOU SHALL HEAR FROM US SHORTLY
</div>';
}

?>
<div class="panel">
<form action="master_action.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label>Email Address</label>
    <input required name="usr_email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">School Email</small>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input required name="usr_fname" type="text" class="form-control"  placeholder="First Name">
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input required name="usr_lname" type="text" class="form-control"  placeholder="Last Name">
  </div>
  <div class="form-group">
    <label>Number of Tickets</label>
    <input required name="usr_qty" type="number" min="1" max="10" class="form-control"  placeholder="Qty">
  </div>
  <div class="form-group">
    <label>Selfie</label>
    <input required name="ch_img" type="file" class="form-control" accept="image/*" aria-describedby="1emailHelp">
        <small id="1emailHelp" class="form-text text-muted">Quick image for identification, Max file size 1MB</small>

  </div>
  
  
  </div>



  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>