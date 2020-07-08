<?php
session_start();
include 'connection.php';
if (!$_SESSION['admin_id']) {
	header('location:admin_login.php');
}
$id=$_SESSION['admin_id'];
include 'linking_files.php';
$pid=$_REQUEST['pid'];
?>
<style>
	th{
		font-size: 17px;
		text-transform: capitalize;
	}
</style>
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
			<li><a href="admin_customerlist.php">CUSTOMERS</a></li>
			<li><a href="admin_prescriptions.php">PRESCRIPTIONS</a></li>
			<li><a href="admin_orderlist.php">ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>

<div class="container">
	<?php
		$fet=$conn->query("SELECT * FROM prescription WHERE id=$pid");
		$fett=mysqli_fetch_array($fet);
		$cid=$fett['cid'];
	?>
	<div style="width: 300px;height: 400px;background-color: red;float: left;background-image: url('../customer/images/prescription/<?php echo $fett['cid']."/".$fett['id']."/".$fett['prescription']?>');background-size: 100% 100%;background-repeat: no-repeat;"></div>
	<div style="float: left;margin-left: 100px;">
		<table class="table">
			<thead>
				<p style="text-align: center;font-size: 18px;font-weight: bold;font-family:MV BOLI;">MEDICINE LIST</p>
				<th>medicine name</th>
				<th>brand</th>
				<th>type</th>
				<th>mg</th>
				<th>allow</th>
			</thead>
			<tbody>
				<?php 
				
				$fet3=$conn->query("SELECT * FROM medicinelist WHERE prescription_required='1'");
				while ($fett3=mysqli_fetch_array($fet3)) {
					$mid=$fett3['lid'];
					$fet4=$conn->query("SELECT * FROM allowed_medicines WHERE cid='$cid' AND mid='$mid'");
					$fet4_all=mysqli_fetch_array($fet4);
					if ($fett3['lid']!=$fet4_all['mid']) {
						$fet5=$conn->query("SELECT * FROM medicinelist WHERE lid='$mid'");
						$fett5=mysqli_fetch_array($fet5);
						?>
						<tr>
				<td style="line-height: 40px;font-size: 16px;text-transform: capitalize;"><?php echo $fett5['name']; ?></td>
				<td style="line-height: 40px;font-size: 16px;text-transform: capitalize;"><?php echo $fett5['brand']; ?></td>
				<td style="line-height: 40px;font-size: 16px;text-transform: capitalize;"><?php echo $fett5['type']; ?></td>
				<td style="line-height: 40px;font-size: 16px;text-transform: capitalize;"><?php echo $fett5['mg']; ?></td>

				
				<td>
					<a href="admin_approvemedicine.php?pid=<?php echo $pid;?>&aid=<?php echo $mid;?>" class="btn btn-info">Approve</a>
				</td>
				</tr>
				<?php 
			}
				}
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<td><a href="admin_prescriptions.php" class="btn btn-warning">Next</a></td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

<?php 

if (isset($_REQUEST['aid'])) {
	$aid=$_REQUEST['aid'];
	$upd1=$conn->query("INSERT INTO allowed_medicines (cid,mid,status,prescription_required) VALUES ('$cid','$aid','1','1')");
		if ($upd1) {
			echo "<script>window.location.href='admin_approvemedicine.php?pid=".$pid."';
				  </script>";
}
}
?>
</body>
</html>



