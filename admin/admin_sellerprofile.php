<?php
session_start();
include 'connection.php';
if (!$_SESSION['admin_id']) {
	header('location:admin_login.php');
}
$id=$_SESSION['admin_id'];
include 'linking_files.php';
$sid=$_REQUEST['sid'];
?>
<style></style>
<title>Home</title>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" style="position: relative;">
		<div class="navbar-header">
			<div class="navbar-brand">MED-OCTOR</div>
		</div>
		<ul class="nav navbar-nav navbar-left">
			<li><a href="admin_profile.php">PROFILE</a></li>
			<li><a href="index.php">SELLERS</a></li>
			<li><a href="admin_medicinelist.php">MEDICINE LIST</a></li>
			<li><a href="admin_prescriptions.php">PRESCRIPTIONS</a></li>
			<li><a href="admin_customerlist.php">CUSTOMERS</a></li>
			<li><a href="admin_orderlist.php">ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>
	
	<div class="col-md-3">
		<div class="col-md-12" style="background-color: #363533;color: white;text-align: center;border-radius: 10px;">
			<?php
			$abc=$conn->query("SELECT * FROM seller_profile WHERE id='$sid'");
			$abcd=mysqli_fetch_array($abc);
			?>
			<label>ID</label>
			<p><?php echo $abcd['id']?></p>
			<hr>
			<label>Name</label>
			<p style="text-transform: capitalize;"><?php echo $abcd['name']?></p>
			<hr>
			<label>Email</label>
			<p><?php echo $abcd['email']?></p>
			<hr>
			<label>Contact</label>
			<p><?php echo $abcd['contact']?></p>
			<hr>
			<label>Address</label>
			<p><?php echo $abcd['address']?></p>
			<hr>
			<label>License</label>
			<p><?php echo $abcd['license']?></p>
			<hr>
			<label>Aadhaar Number</label>
			<p><?php echo $abcd['aadhaar']?></p>
			<hr>
			<label>Account Status</label>
			<p><?php echo $abcd['status']?></p>
			<hr>
			<label>License Proof</label><br>
			

			<span style="width: 100px;height: 100px;"><?php echo "<img src='../seller/images/license/".$sid."/".$abcd['licenseproof']."' height='100px';width:'100px';float='left';>";
					    ?></span>
					
		</div>
	</div>
	<div class="col-md-7 col-md-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;">
		<table class="table">
			<div style="text-align: center;font-weight: bold;font-size: 25px;">ORDERS</div>
			<thead>
				<th>sr no.</th>
				<th>medicine name</th>
				<th>customer name</th>
				<th>order status</th>
				<th>date</th>
			</thead>
			<tbody>
				<?php 
				$sno=0;
				$fet=$conn->query("SELECT * FROM orders WHERE seller_id='$sid' ORDER BY id DESC");
				while ($fett=mysqli_fetch_array($fet)) {
					$sno++;
					$cid=$fett['customer_id'];
					$fe=$conn->query("SELECT * FROM customer_profile WHERE id=$cid");
					$fee=mysqli_fetch_array($fe);
						?>
						<tr>
					    <td><?php echo $sno ?></td>
					    <td><?php echo $fett['medicine_name']?></td>
					    <td><?php echo $fee['name']?></td>
					    <td><?php echo $fett['order_status']?></td>
					    <td><?php echo $fett['order_date']?></td>
					    				    
					   <?php
					}?>	
				
			</tbody>
		</table>
	</div>
	<div class="col-md-12" style="height: 75px;margin-top: 30px;background-color:#f8f8f8;">
		<form class="form" method="post">
			<?php
			if ($abcd['status']==1) {
				?>
				<input type="submit" name="block" value="block seller" class="btn btn-danger" style="margin-left: 48%;margin-top: 20px;">
				<input type="submit" name="activate" value="activate seller" class="btn btn-success" style="margin-left: 10px;margin-top: 20px;">
				<input type="submit" name="deactivate" value="deactivate seller" class="btn btn-warning" style="margin-left: 10px;margin-top: 20px;">
			<?php
				}elseif ($abcd['status']==0) {
					?>
					<input type="submit" name="activate" value="activate seller" class="btn btn-success" style="margin-left: 48%;margin-top: 20px;">
					<input type="submit" name="block" value="block seller" class="btn btn-danger" style="margin-left: 10px;margin-top: 20px;">
					<?php
				}elseif ($abcd['status']==2) {
					?>
					<input type="submit" name="deactivate" value="deactivate seller" class="btn btn-warning" style="margin-left: 48%;margin-top: 20px;">
					<input type="submit" name="block" value="block seller" class="btn btn-danger" style="margin-left: 10px;margin-top: 20px;">
					<?php
				}elseif ($abcd['status']==3) {
					?>
					<input type="submit" name="activate" value="activate seller" class="btn btn-success" style="margin-left: 48%;margin-top: 20px;">
					<?php
				}
			?>
		</form>
	</div>
	<?php
	if (isset($_POST['block'])) {
		$status=3;
			$upd=$conn->query("UPDATE seller_profile SET status='$status' WHERE id='$sid'");
			if ($upd) {?>
					<script>alert('blocked');
					window.location.href='admin_sellerprofile.php?sid=<?php echo $sid;?>';</script>;
			<?php	}else
				{
					echo "<script>alert('error');
 					window.location.href='admin_orderlist.php'</script>";
				}
	}
	if (isset($_POST['activate'])) {
		$status=2;
			$upd=$conn->query("UPDATE seller_profile SET status='$status' WHERE id='$sid'");
			if ($upd) {?>
					<script>alert('activated');
					window.location.href='admin_sellerprofile.php?sid=<?php echo $sid;?>';</script>;
			<?php	}else
				{
					echo "<script>alert('error');
 					window.location.href='admin_orderlist.php'</script>";
				}
	}
	if (isset($_POST['deactivate'])) {
		$status=0;
			$upd=$conn->query("UPDATE seller_profile SET status='$status' WHERE id='$sid'");
			if ($upd) {?>
					<script>alert('deactivated');
					window.location.href='admin_sellerprofile.php?sid=<?php echo $sid;?>';</script>;
			<?php	}else
				{
					echo "<script>alert('error');
 					window.location.href='admin_orderlist.php'</script>";
				}
	}

	?>
</body>
</html>
	