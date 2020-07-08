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
			<li class="active"><a>CUSTOMERS</a></li>
			<li><a href="admin_orderlist.php">ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>
	
	
	<div class="col-md-10 col-md-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;">
		<table class="table">
			<thead>
				<th>sr no.</th>
				<th>customer id</th>
				<th>customer name</th>
				<th>contact</th>
				<th>pin code</th>
				<th>account status</th>
				<th>view profile</th>
			</thead>
			<tbody>
				<?php 
				$sno=0;
				$fet=$conn->query("SELECT * FROM customer_profile ORDER BY name");
				while ($fett=mysqli_fetch_array($fet)) {
					$sno++;
						?>
						<tr>
					    <td><?php echo $sno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td><?php echo $fett['name']?></td>
					    <td><?php echo $fett['contact']?></td>
					    <td><?php echo $fett['pin']?></td>
					    <td><?php echo $fett['status']?></td>
					    <td><a href="admin_customerprofile.php?cid=<?php echo $fett['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-play"></span></button></a></td>					    
					   <?php
					}?>	
				
			</tbody>
		</table>


	</div>
</body>
</html>
	