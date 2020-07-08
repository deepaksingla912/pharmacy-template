<?php
session_start();
include 'connection.php';
if (!$_SESSION['admin_id']) {
	header('location:admin_login.php');
}
$aid=$_SESSION['admin_id'];
include 'linking_files.php';
$fet=$conn->query("SELECT * FROM admin_profile WHERE id=$aid");
$fett=mysqli_fetch_array($fet);
?>
<style>
	.profile-div{
		background-color: #10847e;
		padding: 10px 10px 20px 10px;
		margin-top: 30px;
		color: white;
		border-radius: 20px;
	}
	.form-group label{
		color: white;
	}
	hr{
		width: 100%;
		border: 1px solid lightblue;
		background-color: lightblue;
	}
	@media only screen and (max-width: 768px) {
		.profile-div{
			margin-top: 0px;
			border-radius: 0px;
		}
	}
	.updatename input{
		text-transform: uppercase;
	}
</style>
<title>Home</title>
</head>
<body style="background-color: #e8f4f4;">
	<div class="col-md-4 col-md-offset-4 profile-div">
		<p class="col-md-12" style="font-size: 27px;font-weight: bold;text-align: center;font-family: MV BOLI;">
		<span class="profile" style="">PROFILE</span>
		<span style="float: right;" class="closebtn"><a style="text-decoration: none;" href="index.php" class="btn btn-danger">X</a></span>
		</p>
		<p class="col-md-12 welcome" style="text-transform: uppercase;text-align: center;font-size: 20px;font-weight: bold;">HEY! <?php echo $fett['name']; ?></p>
		<form class="form" method="post">
			<div class="form-group col-md-12 updatename">
				<label>NAME</label>
				<input class="form-control" type="text" name="name" value="<?php echo $fett['name']; ?>"><br>
				<input type="submit" name="update_name" value="UPDATE NAME" class="btn btn-success">
			</div>
		</form>
		<hr><form class="form" method="post">
			<div class="form-group col-md-12 updateuserid">
				<label>USER-ID</label>
				<input class="form-control" type="text" name="userid" value="<?php echo $fett['userid']; ?>"><br>
				<input type="submit" name="update_userid" value="UPDATE USER-ID" class="btn btn-primary">
			</div>
		</form>
		<hr>
		<form class="form" method="post">
			<div class="form-group col-md-12 updatePassword">
				<label>UPDATE PASSWORD</label>
				<input class="form-control" type="password" name="password"><br>
				<input type="submit" name="update_password" value="UPDATE PASSWORD" class="btn btn-warning">
			</div>
		</form>
	</div>
	<?php
	if (isset($_POST['update_password'])) {
		$password=$_POST['password'];
		$upd=$conn->query("UPDATE admin_profile SET password='$password' WHERE id='$aid'");
		if ($upd) {
			echo "<script>alert('PASSWORD HAS BEEN UPDATED NOW PLEASE LOGIN AGAIN');
 			window.location.href='admin_logout.php'</script>";
		}
	}
	if (isset($_POST['update_name'])) {
		$name=$_POST['name'];
		$upd=$conn->query("UPDATE admin_profile SET name='$name' WHERE id='$aid'");
		if ($upd) {
			echo "<script>alert('YOUR NAME HAS BEEN UPDATED');
 			window.location.href='admin_profile.php'</script>";
		}
	}
	if (isset($_POST['update_userid'])) {
		$userid=$_POST['userid'];
		$upd=$conn->query("UPDATE admin_profile SET userid='$userid' WHERE id='$aid'");
		if ($upd) {
			echo "<script>alert('USER-ID HAS BEEN UPDATED NOW PLEASE LOGIN AGAIN');
 			window.location.href='admin_logout.php'</script>";
		}
	}
	?>
</body>
</html>
	