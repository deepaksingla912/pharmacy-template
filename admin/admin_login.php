<?php 
session_start();
include 'connection.php';
if (isset($_SESSION['admin_id'])) {
  header('location:index.php');
}
include 'linking_files.php';
?>


<?php
if (isset($_POST['login'])) {
  $userid=$_POST['userid'];
  $password=$_POST['password'];
  $check=$conn->query("SELECT * FROM admin_profile WHERE userid='$userid' && password='$password'");
    $checkQ=mysqli_fetch_array($check);
  if ($checkQ) {
    $id=$checkQ['id'];
      $_SESSION['admin_id']=$id;
      echo "<script type='text/javascript'>window.location.href='index.php';</script>";
  }else{
      echo "<script type='text/javascript'>alert('YOU AN IMPOSTER?');
      window.location.href='admin_login.php';</script>";
  }
}
?>
<style>
  .main-div{
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    margin-top: 25vh;
  }
  hr{
    width: 100%;
    border: 1px solid lightblue;
    background-color: lightblue;
  }
  @media only screen and (max-width: 768px) {
    .main-div{
      margin-top: 100px;
    }
  }
</style>
<title>admin</title>
</head>
<body style="background-color: #10847e;">
	<div class="col-md-4 col-md-offset-4 main-div">
    <p style="font-size: 30px; font-weight: bold;text-align: center;">WELCOME BOSS</p>
    <hr>
   <form class="form" method="post">
     <div class="form-group">
       <label>USERID</label>
       <input class="form-control" type="text" name="userid" placeholder="user-id" required>
     </div>
     <div class="form-group">
       <label>PASSWORD</label>
       <input class="form-control" type="password" name="password" placeholder="password" required>
     </div>
     <input type="submit" name="login" value="LOG-IN" class="btn btn-primary">
   </form> 
  </div>
</body>
</html>