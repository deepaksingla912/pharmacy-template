<?php 
session_start();
include 'include/connection.php';
include 'include/linking_files.php';
$cid=$_SESSION['customer_id'];
if (!$_SESSION['customer_id']) {
	header('location:index.php');
}
?>


<link rel="stylesheet" type="text/css" href="include/style.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<style type="text/css">
	.table{
		width: 800px;
		float: left;
	}
	input{
		z-index: 0 !important;
	}
</style>
</head>
<body ng-app="" id="home">

<?php
include 'include/navbar.php';
?>
	<script type="text/javascript">
		<?php       
			if ($_SESSION['customer_id']) {
			 	?>
					document.getElementById('profile2').style.display="block";
					document.getElementById('profile1').style.display="block";
					document.getElementById('signinlogin2').style.display="none";
					document.getElementById('signinlogin1').style.display="none";
				<?php
			}
		?>
	</script>
	<?php
	$sel80=$conn->query("SELECT * FROM cart WHERE cid='$cid'");
	$sele80=mysqli_fetch_array($sel80);
	if (!$sele80) {
		?>
		<p style="margin-top: 200px;text-align: center;font-size: 30px;margin-bottom: 200px;">Your Cart Is Empty<br>
			<a href="index.php" class="btn btn-primary">Start Shopping</a>
		</p>
	<?php
	}elseif ($sele80) {
		?>




<div class="container" style="margin-top: 120px;margin-bottom: 50px;">
	<table class="table" style="overflow-x: auto;margin-bottom: 60px;">
		<?php
		$sel=$conn->query("SELECT * FROM cart WHERE cid='$cid'");
		$gtotal=0;
		while ($sele=mysqli_fetch_array($sel)) {
			$mid=$sele['mid'];
			$sel3=$conn->query("SELECT * FROM medicinelist WHERE lid='$mid'");
			$sele3=mysqli_fetch_array($sel3);
			$medname=$sele3['name'];
			$mpq=$sele3['max_purchase_quantity'];
			$sel2=$conn->query("SELECT * FROM mystock WHERE name='$medname' && stock>=$mpq ORDER BY price ASC");
			$sele2=mysqli_fetch_array($sel2);
			$sel4=$conn->query("SELECT * FROM cart WHERE cid='$cid' && mid='$mid'");
			$sele4=mysqli_fetch_array($sel4);
			$mmid=$sele4['mid'];
			?>
		<tr>
			<td style="padding: 5px;cursor: pointer;" onclick="window.location.href = 'medicinepage.php?mid=<?php echo $sele2['id'];?>';"><?php echo "<img src='../admin/images/".$sele3['photo']."' height='100px';width:'100px'; >"; ?></td>
			<td><?php echo "<span style='font-weight: bold;text-transform: capitalize;font-size: 18px;'>".$medname."</span>"." (".$sele2['mg']." "." mg)"?><br><?php echo "BRAND - "."<span style='text-transform: capitalize;'>".$sele2['company']."</span>"?></td>
			    <?php
				    $y=$sele3['price']-$sele2['price'];
			    	$x=$y*100/$sele3['price'];
			    ?>
			
			<td>
				<span><a style="font-size: 25px;padding: 0px 13px;" href="cart.php?dec=<?php echo $mmid;?>" class="btn btn-default">-</a></span>
				<span style="padding: 0px 10px;"><?php echo $sele4['quantity']; ?></span>
				<span><a style="font-size: 25px;padding: 0px 10px;" href="cart.php?inc=<?php echo $mmid;?>" class="btn btn-default">+</a></span>
			</td>
			<td>
				<?php $total=$sele4['quantity']*$sele2['price'];
				$gtotal=$total+$gtotal;
				 ?>
				<p style="font-size: 18px;">₹<?php echo $sele2['price']; ?> <span class="glyphicon glyphicon-remove"></span> <?php echo $sele4['quantity']; ?>  = ₹<?php echo $total; ?></p>
			</td>
			<td>
				<span><a href="cart.php?del=<?php echo $mmid;?>" class="btn btn-danger">Remove</a></span>
			</td>
		</tr>
		<?php
		}?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="background-color: gold;font-size: 18px;font-weight: bold;border-radius: 10px;"><?php
				echo "Total = ₹".$gtotal;
			?></td>
			<td></td>
		</tr>
	</table>
	
	<div style="width: 300px;border: 2px solid #F4F7FB;float: right;font-family: MV BOLI;border-radius: 10px;">
		<p style="text-align: center;font-weight: bold;font-size: 18px;">BILL</p>
		<div style="font-size: 17px;text-align: center;">
			<?php echo "<b>Total : </b>₹".$gtotal.".00"; ?><br>
			<?php 
			if ($gtotal>=500) {
				$shipping=0;
			}elseif ($gtotal<500) {
				$shipping=50;
			}
			 echo "<b>Shipping : </b>₹".$shipping.".00"."<br>";
			 echo "<b style='color:red;'>Total Payable Amount : </b>"."<br>";
			 $ggtotal=$gtotal+$shipping;
			 echo "<span style='color:red;'>"."₹".$ggtotal."</span>";
			  ?>



			 <?php
			$sel12=$conn->query("SELECT * FROM applypromo WHERE cid='$cid' && status='0'");
			$sel_all=mysqli_fetch_array($sel12);
				if ($sel_all) {
					$id=$sel_all['pcid'];
					$fet=$conn->query("SELECT * FROM promo WHERE id='$id'");
					$fet_all=mysqli_fetch_array($fet);
					echo "<div class='alert alert-success'>".$fet_all['offer']."<a href='cart.php?cancel=".$sel_all['id']."' class='close'>x</a></div>";
				}else
				{
			 ?>
			 <form method="post" action="" class="from input-group" style="padding: 10px 20px;">
			 	<input type="text" name="promo" placeholder="ENTER PROMOCODE" class="form-control">
			 	<div class="input-group-btn">
			 		<input type="submit" name="checkpromo" class="btn btn-primary">
			 	</div>

			 </form>

			 <?php
			}
			if (isset($_REQUEST['cancel'])) {
				$id=$_REQUEST['cancel'];
				$dl=$conn->query("DELETE FROM applypromo WHERE id='$id'");
				if ($dl) {
						echo "<script>alert('Coupon Removed'); window.location.href='cart.php';</script>";
				}else
				{
						echo "<script>alert('Technical Issue'); window.location.href='cart.php';</script>";
				}
			}
			 if (isset($_POST['checkpromo'])) {
			 	$promo=$_POST['promo'];
				$sel8=$conn->query("SELECT * FROM promo WHERE promocode='$promo'");
				$sele8=mysqli_fetch_array($sel8);
				$promoid=$sele8['id'];
				$pstatus=1;
				if ($sele8) {
					$sel12=$conn->query("SELECT * FROM applypromo WHERE pcid='$promoid' && cid='$cid' && status='$pstatus' ORDER BY id DESC");
					
					$sele12=mysqli_fetch_array($sel12);

					if ($sele12) {
						echo "<script>alert('Already Applied'); window.location.href='cart.php';</script>";
					}else
					{
					$ins8=$conn->query("INSERT INTO applypromo(cid,pcid,status) VALUES('$cid','$promoid','0')");
					if ($ins8) {
						echo "<script> window.location.href='cart.php';</script>";
					}else
					{
						echo "<script>alert('Technical issue in Coupon'); window.location.href='cart.php';</script>";
					}
					}

					
						?>
					<?php
				}
			 }
			 ?>
		</div>
	</div>





	<div style="width: 300px;float: right;margin-top: 50px;border: 2px solid #F4F7FB;padding: 5px;border-radius: 10px;">
		<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color: #10847e;">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="font-weight: bold;color: white;">Use Default Address<span class="glyphicon glyphicon-list-alt" style="float: right;"></span></a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body" style="text-transform: capitalize;font-size: 15px;">
        	<?php
        	$sel50=$conn->query("SELECT * FROM customer_profile WHERE id='$cid'");
        	$sele50=mysqli_fetch_array($sel50);
        	?>
        	<?php echo "<b>Name : </b>".$sele50['name']; ?><br>
        	<?php echo "<b>Contact : </b>".$sele50['contact']; ?><br>
        	<?php echo "<b>Address : </b>".$sele50['address']; ?><br>
        	<?php echo "<b>PIN Code: </b>".$sele50['pin']; ?>
        	<form method="post" action="" style="text-align: center;margin-top: 10px;">
        		<input type="submit" name="order1" value="ORDER" class="btn btn-primary">
        	</form>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading" style="background-color: #10847e;">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style="font-weight: bold;color: white;">Use A Different Address<span class="glyphicon glyphicon-pencil" style="float: right;"></span></a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
        	<form action="" method="post">
        		<label>Name</label>
        		<input type="text" name="aname" placeholder="Enter Your Name" required class="form-control">
        		<label>Contact</label>
        		<input type="tel" name="acontact" placeholder="Enter Your Mobile Number" required class="form-control">
        		<label>Address</label>
        		<input type="text" name="aaddress" placeholder="Enter Your Address" required class="form-control">
        		<label>PIN CODE</label>
        		<input type="text" name="apin" placeholder="Enter Your PIN Code" required class="form-control">
        		<div class="form-group" style="margin-top: 10px;text-align: center;">
        			<input type="submit" name="order2" value="ORDER" class="btn btn-primary">
        		</div>
        	</form>
        </div>
      </div>
    </div>
  </div> 
</div>
	</div>
</div>



<?php
if (isset($_REQUEST['dec'])) {
	$dec=$_REQUEST['dec'];
	$sel5=$conn->query("SELECT * FROM cart where mid='$dec' && cid='$cid'");
	$sele5=mysqli_fetch_array($sel5);
	$quan=$sele5['quantity'];
	if ($quan>1) {
		$upquan=$quan-1;
		$upd=$conn->query("UPDATE cart SET quantity='$upquan' WHERE cid='$cid' && mid='$dec'");
		if ($upd) {
					echo "<script>window.location.href='cart.php'</script>";
				}else
				{
					echo "<script>alert('error');
 					window.location.href='cart.php'</script>";
				}
	}elseif ($quan==1) {
		
					echo "<script>alert('min quantity is 1');window.location.href='cart.php'</script>";
				
	}
}
if (isset($_REQUEST['inc'])) {
	$inc=$_REQUEST['inc'];
	$sel5=$conn->query("SELECT * FROM cart where mid='$inc' && cid='$cid'");
	$sele5=mysqli_fetch_array($sel5);
	$quan=$sele5['quantity'];
	$sel6=$conn->query("SELECT * FROM medicinelist where lid='$inc'");
	$sele6=mysqli_fetch_array($sel6);
	$quan1=$sele6['max_purchase_quantity'];
	$sel7=$conn->query("SELECT * FROM stock where mid='$inc'");
	$sele7=mysqli_fetch_array($sel7);
	$quan2=$sele7['stock'];
	if ($quan<$quan1) {
		$upquan=$quan+1;
		$upd=$conn->query("UPDATE cart SET quantity='$upquan' WHERE cid='$cid' && mid='$inc'");
		if ($upd) {
					echo "<script>window.location.href='cart.php'</script>";
				}else
				{
					echo "<script>alert('error');
 					window.location.href='cart.php'</script>";
				}
			
	}elseif ($quan==$quan1) {
		
					echo "<script>alert('this is the max allowed quantity for this medicine');window.location.href='cart.php'</script>";
				
	}
}
if (isset($_REQUEST['del'])) {
	$del=$_REQUEST['del'];
	$del5=$conn->query("DELETE FROM cart where mid='$del' && cid='$cid'");
	if ($del5) {
					echo "<script>window.location.href='cart.php'</script>";
				}else
				{
					echo "<script>alert('error');
 					window.location.href='cart.php'</script>";
				}
}

?>
	

<?php
if (isset($_POST['order1'])) {
		$sel60=$conn->query("SELECT * FROM cart WHERE cid='$cid'");
		$ordid=date("y").date("m").date("d").$cid.rand(1,1000);
		$oradd1=$sele50['address']." ".$sele50['pin'];
		$orcon1=$sele50['contact'];
		$orname1=$sele50['name'];
		$sel70=$conn->query("SELECT * FROM applypromo WHERE cid='$cid' && status='0'");
		$sele70=mysqli_fetch_array($sel70);
		$proid1=$sele70['pcid'];
		while ($sele60=mysqli_fetch_array($sel60)) {
			$medid=$sele60['mid'];
			$medquan=$sele60['quantity'];
			$sel61=$conn->query("SELECT * FROM medicinelist WHERE lid='$medid'");
			$sele61=mysqli_fetch_array($sel61);
			$medname1=$sele61['name'];
			$mpq1=$sele61['max_purchase_quantity'];
			$sel62=$conn->query("SELECT * FROM mystock WHERE name='$medname1' && stock>=$mpq1 ORDER BY price ASC");
			$sele62=mysqli_fetch_array($sel62);
			$seid=$sele62['sid'];
			$sequan=$sele62['stock'];
			$medprice=$sele62['price'];
			$odate=date("y/m/d");
			$tot1=$medquan*$medprice;
			$ins60=$conn->query("INSERT INTO orders(medicine_name,customer_id,seller_id,order_status,customer_name,shipping_address,customer_contact,quantity,order_date,orderid,promoid,total,gtotal) VALUES('$medname1','$cid','$seid','1','$orname1','$oradd1','$orcon1','$medquan','$odate','$ordid','$proid1','$tot1','$ggtotal')");
			$selquan=$sequan-$medquan;
			if ($ins60) {
				$sel71=$conn->query("DELETE FROM cart WHERE cid='$cid'");
				$upd71=$conn->query("UPDATE applypromo SET status='1' WHERE cid='$cid' ORDER BY id DESC");
				$upd72=$conn->query("UPDATE mystock SET stock='$selquan' WHERE sid='$seid' && name='$medname1' && stock>=$mpq1 ORDER BY price ASC");
				$sel71=$conn->query("DELETE FROM cart WHERE cid='$cid'");
				echo "<script>alert('done');
 					window.location.href='cart.php'</script>";
			}else{
				echo "<script>alert('error');
 					window.location.href='cart.php'</script>";
			}
		}}
		if (isset($_POST['order2'])) {
		$sel60=$conn->query("SELECT * FROM cart WHERE cid='$cid'");
		$ordid=date("y").date("m").date("d").$cid.rand(1,1000);
		$oradd1=$_POST['aaddress']." ".$_POST['apin'];
		$orcon1=$_POST['acontact'];
		$orname1=$_POST['aname'];
		$sel70=$conn->query("SELECT * FROM applypromo WHERE cid='$cid' && status='0'");
		$sele70=mysqli_fetch_array($sel70);
		$proid1=$sele70['pcid'];
		while ($sele60=mysqli_fetch_array($sel60)) {
			$medid=$sele60['mid'];
			$medquan=$sele60['quantity'];
			$sel61=$conn->query("SELECT * FROM medicinelist WHERE lid='$medid'");
			$sele61=mysqli_fetch_array($sel61);
			$medname1=$sele61['name'];
			$mpq1=$sele61['max_purchase_quantity'];
			$sel62=$conn->query("SELECT * FROM mystock WHERE name='$medname1' && stock>=$mpq1 ORDER BY price ASC");
			$sele62=mysqli_fetch_array($sel62);
			$seid=$sele62['sid'];
			$medprice=$sele62['price'];
			$sequan=$sele62['stock'];
			$odate=date("y/m/d");
			$tot1=$medquan*$medprice;
			$ins60=$conn->query("INSERT INTO orders(medicine_name,customer_id,seller_id,order_status,customer_name,shipping_address,customer_contact,quantity,order_date,orderid,promoid,total,gtotal) VALUES('$medname1','$cid','$seid','1','$orname1','$oradd1','$orcon1','$medquan','$odate','$ordid','$proid1','$tot1','$ggtotal')");
			$selquan=$sequan-$medquan;
			if ($ins60) {
				$sel71=$conn->query("DELETE FROM cart WHERE cid='$cid'");
				$upd71=$conn->query("UPDATE applypromo SET status='1' WHERE cid='$cid' ORDER BY id DESC");
				$upd72=$conn->query("UPDATE mystock SET stock='$selquan' WHERE sid='$seid' && name='$medname1' && stock>=$mpq1 ORDER BY price ASC");
				echo "<script>alert('done');
 					window.location.href='cart.php'</script>";
			}else{
				echo "<script>alert('error');
 					window.location.href='cart.php'</script>";
			}
		}}
			?>

<?php
}
	?>


<?php 

include 'include/footer.php';

?>



</body>
</html>
