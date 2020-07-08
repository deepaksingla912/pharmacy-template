<?php
session_start();
include 'connection.php';
if (!$_SESSION['admin_id']) {
	header('location:admin_login.php');
}
$id=$_SESSION['admin_id'];
include 'linking_files.php';
?>
<style></style>
<title>Home</title>
</head>
<body style="overflow-x: hidden;">
	<nav class="navbar navbar-default navbar-fixed-top" style="position: relative;">
		<div class="navbar-header">
			<div class="navbar-brand">MED-OCTOR</div>
		</div>
		<ul class="nav navbar-nav navbar-left">
			<li><a href="admin_profile.php">PROFILE</a></li>
			<li><a href="index.php">SELLERS</a></li>
			<li><a href="admin_medicinelist.php">MEDICINE LIST</a></li>
			<li class="active"><a>PRESCRIPTIONS</a></li>
			<li><a href="admin_customerlist.php">CUSTOMERS</a></li>
			<li><a href="admin_orderlist.php">ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>
	<div class="container text-center">
		<?php
		$fet1=$conn->query("SELECT * FROM prescription WHERE upload_status='1' ORDER BY id ASC");
		$fett1=mysqli_fetch_array($fet1);
		$pid=$fett1['id'];
		?>
		<div style="width: 80%;height: 600px;margin-left: 10%;background-image: url('../customer/images/prescription/<?php echo $fett1['cid']."/".$fett1['id']."/".$fett1['prescription']?>');background-size: 100% 100%;background-repeat: no-repeat;"></div>
		<form method="post" action="" class="btn-group" style="margin-top: 20px;">
			<input type="submit" name="reject" value="REJECT" class="btn btn-danger" style="padding: 10px;font-size: 18px;">
			<input type="submit" name="approve" value="APPROVE" class="btn btn-success" style="padding: 10px;font-size: 18px;">
		</form>
	</div>
	<?php
	if (isset($_POST['reject'])) {
		$upd1=$conn->query("UPDATE prescription SET upload_status='0' WHERE id='$pid'");
		if ($upd1) {
			echo "<script>alert('rejected');
								window.location.href='admin_prescriptions.php'</script>";
		}
	}
	if (isset($_POST['approve'])) {
		$upd1=$conn->query("UPDATE prescription SET upload_status='2' WHERE id='$pid'");
		if ($upd1) {
			echo "<script>window.location.href='admin_approvemedicine.php?pid=".$pid."';
				  </script>";

		}
	}
	?>
</body>
</html>
	