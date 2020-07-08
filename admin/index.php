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
			<li class="active"><a>SELLERS</a></li>
			<li><a href="admin_medicinelist.php">MEDICINE LIST</a></li>
			<li><a href="admin_customerlist.php">CUSTOMERS</a></li>
			<li><a href="admin_prescriptions.php">PRESCRIPTIONS</a></li>
			<li><a href="admin_orderlist.php">ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>
	<div class="col-md-12" style="margin-bottom: 50px;">
		<form method="post" style="float: left;margin-left: 5px">
			<input type="submit" name="allsellers" value="ALL SELLERS" class="btn btn-danger">
		</form>
		<form method="post" style="float: left;margin-left: 5px">
			<input type="submit" name="newsellers" value="NEW SELLERS" class="btn btn-danger">
		</form>
		<form method="post" style="float: left;margin-left: 5px">
			<input type="submit" name="unactivesellers" value="UNACTIVE SELLERS" class="btn btn-danger">
		</form>
		<form method="post" style="float: left;margin-left: 5px">
			<input type="submit" name="blockedsellers" value="BLOCKED SELLERS" class="btn btn-danger">
		</form>
		<form method="post" style="float: left;margin-left: 5px">
			<input type="submit" name="activesellers" value="ACTIVE SELLERS" class="btn btn-danger">
		</form>
	</div>
	
	<div class="col-md-10 col-md-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;">
    <!-- -------------------------------------------all-------------------------------------------->
	<?php
	if (isset($_POST['allsellers'])) {
		?><table class="table">
			<div class="col-md-12" style="font-size: 25px;text-align: center;"><?php echo "ALL SELLERS"; ?></div>
			<tr>
					<td>sr. no.</td>
					<td>id</td>
					<td>name</td>
					<td>email</td>
					<td>contact</td>
					<td>pin</td>
					<td>license</td>
					<td>aadhaar</td>
					<td>status</td>
					<td>unactive</td>
					<td>active</td>
					<td>block</td>
				</tr>
				<?php 
				$srno=0;
				$fet=$conn->query("SELECT * FROM seller_profile ORDER BY name");
				while ($fett=mysqli_fetch_array($fet)) {
					$srno++;
						?>
						<tr style="cursor: pointer;" onclick="window.location.href = 'admin_sellerprofile.php?sid=<?php echo $fett['id'];?>';">
					    <td><?php echo $srno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td class="name"><?php echo $fett['name']?></td>
					    <td><?php echo $fett['email']?></td>
					    <td><?php echo $fett['contact']?></td>
					    <td><?php echo $fett['pin']?></td>
					    <td><?php echo $fett['license']?></td>
					    <td><?php echo $fett['aadhaar']?></td>
					    <td><?php echo $fett['status']?></td>
					    <td><a href="index.php?did=<?php echo $fett['id'];?>" class="btn	btn-warning">deactivate</a></td>
					    <td><a href="index.php?aid=<?php echo $fett['id'];?>" class="btn	btn-success">activate</a></td>
					    <td><a href="index.php?bid=<?php echo $fett['id'];?>" class="btn	btn-danger">block</a></td>
						</tr><?php
					}?>	
		</table>


	<?php
	}?>	

  

	<!-- ----------------------------------------unactive------------------------------------------------- -->
	<?php
	if (isset($_POST['unactivesellers'])) {
		?><table class="table">
			<p style="font-size: 25px;text-align: center;"><?php echo "UNACTIVE SELLERS"; ?></p>
			<tr>
					<td>sr. no.</td>
					<td>id</td>
					<td>name</td>
					<td>email</td>
					<td>contact</td>
					<td>pin</td>
					<td>license</td>
					<td>aadhaar</td>
					<td>active</td>
					<td>block</td>
				</tr>
				<?php 
				$srno=0;
				$status=0;
				$fet=$conn->query("SELECT * FROM seller_profile WHERE status='$status' ORDER BY id ASC");
				while ($fett=mysqli_fetch_array($fet)) {
					$srno++;
						?>
						<tr style="cursor: pointer;" onclick="window.location.href = 'admin_sellerprofile.php?sid=<?php echo $fett['id'];?>';">
					    <td><?php echo $srno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td><?php echo $fett['name']?></td>
					    <td><?php echo $fett['email']?></td>
					    <td><?php echo $fett['contact']?></td>
					    <td><?php echo $fett['pin']?></td>
					    <td><?php echo $fett['license']?></td>
					    <td><?php echo $fett['aadhaar']?></td>
					    <td><a href="index.php?aid=<?php echo $fett['id'];?>" class="btn	btn-success">activate</a></td>
					    <td><a href="index.php?bid=<?php echo $fett['id'];?>" class="btn	btn-danger">block</a></td>
						</tr><?php
					}?>	
		</table>
	<?php
	}?>	

	<!-- -----------------------------------pending new------------------------------------- -->
	<?php
	if (isset($_POST['newsellers'])) {
		?><table class="table">
			<p style="font-size: 25px;text-align: center;"><?php echo "NEW SELLERS"; ?></p>
			<tr>
					<td>sr. no.</td>
					<td>id</td>
					<td>name</td>
					<td>email</td>
					<td>contact</td>
					<td>pin</td>
					<td>license</td>
					<td>aadhaar</td>
					<td>unactive</td>
					<td>active</td>
					<td>block</td>
				</tr>
				<?php 
				$srno=0;
				$status=1;
				$fet=$conn->query("SELECT * FROM seller_profile WHERE status='$status' ORDER BY id ASC");
				while ($fett=mysqli_fetch_array($fet)) {
					$srno++;
						?>
						<tr style="cursor: pointer;" onclick="window.location.href = 'admin_sellerprofile.php?sid=<?php echo $fett['id'];?>';">
					    <td><?php echo $srno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td><?php echo $fett['name']?></td>
					    <td><?php echo $fett['email']?></td>
					    <td><?php echo $fett['contact']?></td>
					    <td><?php echo $fett['pin']?></td>
					    <td><?php echo $fett['license']?></td>
					    <td><?php echo $fett['aadhaar']?></td>
					    <td><a href="index.php?did=<?php echo $fett['id'];?>" class="btn	btn-warning">deactivate</a></td>
					    <td><a href="index.php?aid=<?php echo $fett['id'];?>" class="btn	btn-success">activate</a></td>
					    <td><a href="index.php?bid=<?php echo $fett['id'];?>" class="btn	btn-danger">block</a></td>
						</tr><?php
					}?>	
		</table>
	<?php
	}?>	
	<!-- ----------------------------------------blocked------------------------------------------------- -->
	<?php
	if (isset($_POST['blockedsellers'])) {
		?><table class="table">
			<p style="font-size: 25px;text-align: center;"><?php echo "BLOCKED SELLERS"; ?></p>
			<tr>
					<td>sr. no.</td>
					<td>id</td>
					<td>name</td>
					<td>email</td>
					<td>contact</td>
					<td>pin</td>
					<td>license</td>
					<td>aadhaar</td>
					<td>unactive</td>
					<td>active</td>
				</tr>
				<?php 
				$srno=0;
				$status=3;
				$fet=$conn->query("SELECT * FROM seller_profile WHERE status='$status' ORDER BY id ASC");
				while ($fett=mysqli_fetch_array($fet)) {
					$srno++;
						?>
						<tr style="cursor: pointer;" onclick="window.location.href = 'admin_sellerprofile.php?sid=<?php echo $fett['id'];?>';">
					    <td><?php echo $srno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td><?php echo $fett['name']?></td>
					    <td><?php echo $fett['email']?></td>
					    <td><?php echo $fett['contact']?></td>
					    <td><?php echo $fett['pin']?></td>
					    <td><?php echo $fett['license']?></td>
					    <td><?php echo $fett['aadhaar']?></td>
					    <td><a href="index.php?did=<?php echo $fett['id'];?>" class="btn	btn-warning">deactivate</a></td>
					    <td><a href="index.php?aid=<?php echo $fett['id'];?>" class="btn	btn-success">activate</a></td>
					    
						</tr><?php
					}?>	
		</table>
	<?php
	}?>	
	<!-- ---------------------------------------active new-------------------------------------------- -->
	<?php
	if (isset($_POST['activesellers'])) {
		?><table class="table">
			<p style="font-size: 25px;text-align: center;"><?php echo "ACTIVE SELLERS"; ?></p>
			<tr>
					<td>sr. no.</td>
					<td>id</td>
					<td>name</td>
					<td>email</td>
					<td>contact</td>
					<td>pin</td>
					<td>license</td>
					<td>aadhaar</td>
					<td>unactive</td>
					<td>block</td>
				</tr>
				<?php 
				$srno=0;
				$status=2;
				$fet=$conn->query("SELECT * FROM seller_profile WHERE status='$status' ORDER BY id ASC");
				while ($fett=mysqli_fetch_array($fet)) {
					$srno++;
						?>
						<tr style="cursor: pointer;" onclick="window.location.href = 'admin_sellerprofile.php?sid=<?php echo $fett['id'];?>';">
					    <td><?php echo $srno ?></td>
					    <td><?php echo $fett['id']?></td>
					    <td><?php echo $fett['name']?></td>
					    <td><?php echo $fett['email']?></td>
					    <td><?php echo $fett['contact']?></td>
					    <td><?php echo $fett['pin']?></td>
					    <td><?php echo $fett['license']?></td>
					    <td><?php echo $fett['aadhaar']?></td>
					    <td><a href="index.php?did=<?php echo $fett['id'];?>" class="btn	btn-warning">deactivate</a></td>
					    <td><a href="index.php?bid=<?php echo $fett['id'];?>" class="btn	btn-danger">block</a></td>
						</tr><?php
					}?>	
		</table>
	<?php
	}?>	
	


   <!-- ---------------------------------------buttons logic---------------------------------- -->


   <?php
						

       if (isset($_REQUEST['did'])) {
				$did=$_REQUEST['did'];
				$status=0;
				$upd=$conn->query("UPDATE seller_profile SET status='$status' WHERE id='$did'");
					if ($upd) {
					echo "<script>alert('deactivated');
					window.location.href='index.php'</script>";
				}
				else{
					echo "<script>alert('error');
					window.location.href='index.php'</script>";
				}
			}
			elseif (isset($_REQUEST['aid'])) {
				$aid=$_REQUEST['aid'];
				$status=2;
				$upd=$conn->query("UPDATE seller_profile SET status='$status' WHERE id='$aid'");
					if ($upd) {
					echo "<script>alert('activated');
					window.location.href='index.php'</script>";
				}
				else{
					echo "<script>alert('error');
					window.location.href='index.php'</script>";
				}
			}
			elseif (isset($_REQUEST['bid'])) {
				$bid=$_REQUEST['bid'];
				$status=3;
				$upd=$conn->query("UPDATE seller_profile SET status='$status' WHERE id='$bid'");
					if ($upd) {
					echo "<script>alert('blocked');
					window.location.href='index.php'</script>";
				}
				else{
					echo "<script>alert('error');
					window.location.href='index.php'</script>";
				}
			}

	?>


</div>
	</body>
	</html>
	