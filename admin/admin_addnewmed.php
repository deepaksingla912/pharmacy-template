<?php
session_start();
include 'connection.php';
if (!$_SESSION['admin_id']) {
	header('location:admin_login.php');
}
$aid=$_SESSION['admin_id'];
include 'linking_files.php';
?>
<style>
	.main-div{
		background-color: #10847e;
		padding: 10px 10px 20px 10px;
		margin-top: 30px;
		color: white;
		border-radius: 20px;
	}
	.form-group label{
		color: white;
	}
	@media only screen and (max-width: 768px) {
		.main-div{
			margin-top: 0px;
			border-radius: 0px;
		}
	}
</style>
<title>Home</title>
</head>
<body style="background-color: #e8f4f4;">
	<div class="col-md-4 col-md-offset-4 main-div">
		<p class="col-md-12" style="font-size: 27px;font-weight: bold;">
		<span class="profile">Add new medicine</span>
		<span style="float: right;" class="closebtn"><a style="text-decoration: none;" href="admin_medicinelist.php" class="btn btn-danger">X</a></span>
		</p>
		<form class="form" method="post" enctype="multipart/form-data">
			<div class="form-group col-md-12">
				<label>NAME OF MEDICINE</label>
				<input class="form-control" type="text" name="name">
			</div>
			<div class="form-group col-md-12">
				<label>BRAND</label>
				<input class="form-control" type="text" name="brand">
			</div>
			<div class="form-group col-md-12">
				<label>mg</label>
				<input class="form-control" type="text" name="mg">
			</div>
			<div class="form-group col-md-6">
				<label>TYPE</label>
				<input class="form-control" type="text" name="type">
			</div>
			<div class="form-group col-md-6">
				<label>MRP</label>
				<input class="form-control" type="text" name="mrp">
			</div>
			<div class="form-group col-md-12">
				<label>PRESCRIPTION REQUIRED</label><br>
				<label for="yes">Yes</label>
				<input type="radio" name="prescription_required" value="1" id="yes">
				<label for="no">No</label>
				<input type="radio" name="prescription_required" value="0" id="no">
			</div>
			<div class="form-group col-md-6">
				<label>MAX PURCHASE</label>
				<input class="form-control" type="text" name="max_purchase_quantity">
			</div>
			<div class="form-group  col-md-6">
					<label>Photo</label>
					<input type="file" name="image" class="form-control" accept="image/*">
			</div>
			<div class="form-group col-md-12">
				<input type="submit" name="addnewmed" value="Add new medicine" class="btn btn-primary">
			</div>
			
		</form>
		

		
	</div>
	<?php
	if (isset($_POST['addnewmed'])) {
		$mname=$_POST['name'];
		$brand=$_POST['brand'];
		$mg=$_POST['mg'];
		$type=$_POST['type'];
		$mrp=$_POST['mrp'];
		$prescription_required=$_POST['prescription_required'];
		$max_purchase_quantity=$_POST['max_purchase_quantity'];
		$name=$_FILES['image']['name'];
		$tmp=$_FILES['image']['tmp_name'];
		$dir="images";
		move_uploaded_file($tmp,$dir."/".$name);
		$ins=$conn->query("INSERT INTO medicinelist(name,brand,mg,type,price,prescription_required,max_purchase_quantity,photo) VALUES ('$mname','$brand','$mg','$type','$mrp','$prescription_required','$max_purchase_quantity','$name')");
		if ($ins) {
			echo "<script>alert('NEW MEDICINE HAS BEEN ADDED TO LIST');
 			window.location.href='admin_medicinelist.php'</script>";
		}
	}
	
	?>
</body>
</html>
	