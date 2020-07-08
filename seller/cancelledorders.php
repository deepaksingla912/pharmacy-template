<?php
session_start();
include 'connection.php';
if (!$_SESSION['seller_id']) {
	header('location:seller_login.php');
}
$sid=$_SESSION['seller_id'];
include 'linking_files.php';
?>
<style></style>
<title>Home</title>
</head>
<body  ng-app="">
	<nav class="navbar navbar-default navbar-fixed-top" style="position: relative;">
		<div class="navbar-header">
			<div class="navbar-brand">MED-OCTOR</div>
		</div>
		<ul class="nav navbar-nav navbar-left">
			<li><a href="seller_profile.php">Profile</a></li>
			<li><a href="index.php">My Stock</a></li>
			<li class="active"><a>My Orders</a></li>
			<li class="navbar-form">
				<form action="" method="post" class="form input-group">
					<input class="form-control" ng-model="search" type="text" name="search" placeholder="enter order-id">
					<div class="input-group-btn"><a href="searchresult.php?seid={{search}}" class="btn btn-default">
			        <div class="glyphicon glyphicon-search"></div></a>
				</form>
			</li>
			<li><a href="seller_logout.php">Log-Out</a></li>
		</ul>
		</nav>
		<div class="col-lg-12">
			<a href="myorders.php" class="btn btn-primary">ALL ORDERS</a>
			<a href="unprocessedorders.php" class="btn btn-success">UNPROCESSED ORDERS</a>
			<a href="processedorders.php" class="btn btn-warning">PROCESSED ORDERS</a>
			<a href="shippedorders.php" class="btn btn-danger">SHIPPED ORDERS</a>
			<a href="cancelledorders.php" class="btn btn-info">CANCELLED ORDERS</a>
		</div>
		<div class="col-lg-10 col-lg-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;margin-top: 20px;">
			<p style="font-size: 25px;text-align: center;">My Orders</p>
			<table class="table">
				<tr>
					<td>sno</td>
					<td>order id</td>
					<td>name</td>
					<td>brand</td>
					<td>quantity</td>
					<td>shipping address</td>
					<td>customer contact</td>
					<td>view</td>
				</tr>
				<?php 
				$sno=0;
				$status=0;
				$fet=$conn->query("SELECT * FROM orders WHERE seller_id='$sid' && order_status='$status'");
				while ($fett=mysqli_fetch_array($fet)) {
					$mname=$fett['medicine_name'];
					$ord=$conn->query("SELECT * FROM mystock WHERE sid='$sid' && name='$mname'");
					$orde=mysqli_fetch_array($ord);
					$sno++;
						?>
						<tr>
					    <td><?php echo $sno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td><?php echo $fett['medicine_name']?></td>
					    <td><?php echo $orde['company']?></td>
					    <td><?php echo $fett['quantity']?></td>
					    <td><?php echo $fett['shipping_address']?></td>
					    <td><?php echo $fett['customer_contact']?></td>
					    <td><a href="vieworder.php?oid=<?php echo $fett['id'];?>"><button class="btn btn-default"><span class="glyphicon glyphicon-play"></span></button></a></td>	
						</tr><?php
					}?>	



					
	</table>			
		</div>











	</body>
	</html>
	