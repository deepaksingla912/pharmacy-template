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
			<li><a href="admin_customerlist.php">CUSTOMERS</a></li>
			<li class="active"><a>ORDERS</a></li>
			<li><a href="admin_logout.php">LOG-OUT</a></li>
		</ul>
	</nav>
	
	
	<div class="col-md-10 col-md-offset-1" style="background-color: #e8f4f4;border-radius: 10px;padding: 10px;">
		<table class="table">
			<thead>
				<th>sr no.</th>
				<th>medicine</th>
				<th>customer id</th>
				<th>seller id</th>
				<th>quantity</th>
				<th>status</th>
				<th>order date</th>
				<th>cancel order</th>
			</thead>
			<tbody>
				<?php 
				$sno=0;
				$fet=$conn->query("SELECT * FROM orders ORDER BY id DESC");
				while ($fett=mysqli_fetch_array($fet)) {
					$sno++;
						?>
						<tr>
					    <td><?php echo $sno ?></td>
					    <td><?php echo $fett['medicine_name']?></td>
					    <td><a href="admin_customerprofile.php?cid=<?php echo $fett['customer_id'];?>"><?php echo $fett['customer_id']?></a></td>
					    <td><a href="admin_sellerprofile.php?sid=<?php echo $fett['seller_id'];?>"><?php echo $fett['seller_id']?></a></td>
					    <td><?php echo $fett['quantity']?></td>
					    <td><?php echo $fett['order_status']?></td>
					    <td><?php echo $fett['order_date']?></td>
					    <td><a href="admin_orderlist.php?oid=<?php echo $fett['orderid'];?>" class="btn btn-danger">Cancel</a></td>
					   <?php
					}?>	
					<?php
			if (isset($_REQUEST['oid'])) {
				$oid=$_REQUEST['oid'];
				$del=$conn->query("UPDATE orders SET order_status='0' WHERE orderid='$oid'");
				if ($del) {
					echo "<script>alert('cancelled');
								window.location.href='admin_orderlist.php'</script>";
				}else
				{
					echo "<script>alert('error');
 					window.location.href='admin_orderlist.php'</script>";
				}

			}
			?>	
			
					
				
			</tbody>
		</table>


	</div>
</body>
</html>
	