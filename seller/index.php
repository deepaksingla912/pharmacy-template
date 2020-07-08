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
<body ng-app="">
	<nav class="navbar navbar-default navbar-fixed-top" style="position: relative;">
		<div class="navbar-header">
			<div class="navbar-brand">MED-OCTOR</div>
		</div>
		<ul class="nav navbar-nav navbar-left">
			<li><a href="seller_profile.php">Profile</a></li>
			<li class="active"><a>My Stock</a></li>
			<li><a href="myorders.php">My Orders</a></li>
			<li class="navbar-form">
				<form action="" method="post" class="form input-group">
					<input class="form-control" ng-model="search" type="text" name="search" placeholder="enter order-id">
					<div class="input-group-btn"><a href="searchresult.php?seid={{search}}" class="btn btn-default">
			        <div class="glyphicon glyphicon-search"></div></a></div>
				</form>
			</li>
			<li><a href="seller_logout.php">Log-Out</a></li>
		</ul>
		</nav>
		<div class="col-lg-12"><br></div>
		<div class="col-lg-5 col-lg-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;overflow-x: auto;">
			<p style="font-size: 25px;text-align: center;">My Stock</p>
			<table class="table">
				<tr>
					<td>sno</td>
					<td>name</td>
					<td>brand</td>
					<td>use type</td>
					<td>mg</td>
					<td>price</td>
					<td>stock</td>
					<td>update</td>
					<td>remove</td>
				</tr>
				<?php 
				$sno=0;
				$fet=$conn->query("SELECT * FROM mystock WHERE sid='$sid' ORDER BY name ASC");
				while ($fett=mysqli_fetch_array($fet)) {
					$sno++;
						?>
						<tr>
					    <td><?php echo $sno ?></td>
					    <td><?php echo $fett['name']?></td>
					    <td><?php echo $fett['company']?></td>
					    <td><?php echo $fett['type']?></td>
					    <td><?php echo $fett['mg']?></td>
					    <td><?php echo $fett['price']?></td>
					    <td><?php echo $fett['stock']?></td>
					    <td><a href="updatestock.php?id=<?php echo $fett['id'];?>" class="btn btn-success">update</a></td>
					    <td><a href="index.php?id=<?php echo $fett['id'];?>" class="btn btn-danger">remove</a></td>
						</tr><?php
					}?>	



					<?php
			if (isset($_REQUEST['id'])) {
				$idd=$_REQUEST['id'];
				$del=$conn->query("DELETE FROM mystock WHERE id='$idd'");
				if ($del) {
					echo "<script>window.location.href='index.php'</script>";
				}else
				{
					echo "<script>alert('error');
 					window.location.href='index.php'</script>";
				}

			}
			?>	
	</table>			
		</div>











		<div class="col-lg-5 abc" style="">
			<p style="font-size: 25px;text-align: center;">Medicine List</p>
			<table class="table">
		<tr>
			<td>sno.</td>
			<td>name</td>
			<td>brand</td>
			<td>mg</td>
			<td>use type</td>
			<td>MRP</td>
			<td>add to stock</td>
		</tr>
		<?php 
		$fet=$conn->query("SELECT * FROM medicinelist ORDER BY name ASC");
		$srno=0;
		while ($fett=mysqli_fetch_array($fet)) {
			$srno++;

				?>
				<tr>
			    <td><?php echo $srno?></td>
			    <td><?php echo $fett['name']?></td>
			    <td><?php echo $fett['brand']?></td>
			    <td><?php echo $fett['mg']?></td>
			    <td><?php echo $fett['type']?></td>
			    <td><?php echo $fett['price']?></td>
			    <td><a href="index.php?lid=<?php echo $fett['lid'];?>" class="btn btn-primary">add to stock</a></td>
				</tr><?php
			}?>	
	</table>
		</div>

		<?php
			if (isset($_REQUEST['lid'])) {
				$lid=$_REQUEST['lid'];
				$fet=$conn->query("SELECT * FROM medicinelist WHERE lid='$lid'");
				$fett=mysqli_fetch_array($fet);
				$name=$fett['name'];
				$brand=$fett['brand'];
				$mg=$fett['mg'];
				$type=$fett['type'];
				$price=$fett['price'];
				$check=$conn->query("SELECT * FROM mystock WHERE name='$name' && sid='$sid'");
				$checkq=mysqli_fetch_array($check);
					if ($checkq) {
					echo "<script>alert('already exist');
					window.location.href='index.php'</script>";
				}
				else{
					$ins=$conn->query("INSERT INTO mystock(name,company,type,mg,price,sid) VALUES('$name','$brand','$type','$mg','$price','$sid')");
					echo "<script>window.location.href='index.php'</script>";
				}
			}
			?>	
			<style type="text/css">
				.abc{
					background-color: #e8f4f4;
					border-radius: 10px;
					padding: 10px;
					margin-left: 20px;
					overflow-x: auto;
				}
				@media only screen and (max-width: 1199px) {
					.abc{
					margin-left: 0px;
					margin-top: 20px;
					}
				}
				@media only screen and (max-width: 765px) {
					body{
					overflow-x: hidden;
					}
				}
			</style>
	</body>
	</html>
	