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
			<li class="active"><a>MEDICINE LIST</a></li>
			<li><a href="admin_prescriptions.php">PRESCRIPTIONS</a></li>
			<li><a href="admin_customerlist.php">CUSTOMERS</a></li>
			<li><a href="admin_orderlist.php">ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>
	<div class="col-md-12" style="margin-bottom: 10px;">
		<a href="admin_addnewmed.php" class="btn btn-success">Add new medicine</a>
	</div>
	
	<div class="col-md-10 col-md-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;">
		<table class="table">
			<thead>
				<th>sr no.</th>
				<th>name</th>
				<th>image</th>
				<th>brand</th>
				<th>type</th>
				<th>mrp</th>
				<th>update</th>
				<th>remove</th>
			</thead>
			<tbody>
				<?php 
				$sno=0;
				$fet=$conn->query("SELECT * FROM medicinelist ORDER BY name ASC");
				while ($fett=mysqli_fetch_array($fet)) {
					$sno++;
						?>
						<tr>
					    <td><?php echo $sno ?></td>
					    <td><?php echo $fett['name']?></td>
					    <td style="height: 100px;width: 100px;"><?php echo "<img src='images/".$fett['photo']."' height='100px';width:'100px'; >";
					    ?></td>

					    <td><?php echo $fett['brand']?></td>
					    <td><?php echo $fett['type']?></td>
					    <td><?php echo $fett['price']?></td>
					    <td><a href="updatelist.php?lid=<?php echo $fett['lid'];?>" class="btn btn-warning">update</a></td>
					    <td><a href="admin_medicinelist.php?lid=<?php echo $fett['lid'];?>" class="btn btn-danger">remove</a></td>
						</tr><?php
					}?>	
					<?php
			if (isset($_REQUEST['lid'])) {
				$lid=$_REQUEST['lid'];
				$del=$conn->query("DELETE FROM medicinelist WHERE lid='$lid'");
				if ($del) {
					echo "<script>alert('deleted');
								window.location.href='admin_medicinelist.php'</script>";
				}else
				{
					echo "<script>alert('error');
 					window.location.href='admin_medicinelist.php'</script>";
				}

			}
			?>	
				
			</tbody>
		</table>


	</div>
</body>
</html>
	