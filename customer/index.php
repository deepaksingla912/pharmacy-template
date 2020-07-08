<?php 
session_start();
include 'include/connection.php';
include 'include/linking_files.php';
?>


<?php
if (isset($_POST['signin'])) {
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $contact=$_POST['contact'];
  $address=$_POST['address'];
  $pin=$_POST['pin'];
  $check=$conn->query("SELECT * FROM customer_profile WHERE `email`='$email'");
 	$abc=mysqli_fetch_array($check);
 	if ($abc) {
 		echo "<script>alert('This Email Id Already Registered');
 		window.location.href='index.php'</script>";
 	}
 	else{
  		$ins=$conn->query("INSERT INTO customer_profile(name,email,password,contact,address,pin) VALUES('$name','$email','$password','$contact','$address','$pin')");
 		 if ($ins) {
   			echo "<script type='text/javascript'>alert('registered');
      		header('location:index.php');</script>";
  		}
  		else{
    		echo "<script type='text/javascript'>alert('something went wrong');
    		window.location.href='index.php';</script>";
  		}
	}
}
?>

<?php
if (isset($_POST['login'])) {
  $email=$_POST['email'];
  $password=$_POST['password'];
  $check=$conn->query("SELECT * FROM customer_profile WHERE email='$email' && password='$password'");
    $checkQ=mysqli_fetch_array($check);
  if ($checkQ) {
    
    if ($checkQ['status']==0) {
      echo "<script type='text/javascript'>alert('your account has been blocked');
            window.location.href='index.php';</script>";
    }elseif ($checkQ['status']==1) {
      $cid=$checkQ['id'];
      $_SESSION['customer_id']=$cid;
      echo "<script type='text/javascript'>window.location.href='index.php';</script>";
    }
  }else{
        echo "<script type='text/javascript'>alert('wrong credentials');
            window.location.href='index.php';</script>";
    }
}
?>
<link rel="stylesheet" type="text/css" href="include/style.css">
<style type="text/css">
	hr{
	width: 100%;
	position: absolute;
	left: 0px;
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body ng-app="" id="home" style="overflow-x: hidden;">
<?php
include 'login.php';
?>
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


<div class="container carousel-main">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators" style="z-index: 1;">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="item active">
      <img src="images/1.jpg">
    </div>

    <div class="item">
      <img src="images/3.jpg"> 
    </div>

    <div class="item">
      <img src="images/2.jpg">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<div class="container">
	<p style="font-size: 20px; margin: 20px 0px;font-weight: bold;width: 100%;">Order Medicines Online</p>
	<div class="search-main">
		<div class="permanent-offers">
    		<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/8bfde66a.svg"><span>Flat 20% off</span>  
    		<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/adb9b646.svg"><span>1 Lakh+ Products</span>
    		<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/9279f530.svg"><span>Easy Returns</span>
    	</div>
		<p>Search Medicine</p>
		<form method="post" class="form input-group">
			<input class="form-control" ng-model="search" type="text" name="search" placeholder="Enter medicine name" ng-modal="search" style="z-index: 0">
			<div class="input-group-btn"><a href="seachresult.php?sname={{search}}" class="btn btn-default"><div class="glyphicon glyphicon-search"></div></a></div>
		</form>
	</div>

<div class="orderOptions">
	<div class="prescriptionYes">
		<a href="uploadprescription.php" class="btn btn-default">
			<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/ef63c33a.svg">
			<span>&#707;</span>
			<p>Order Via Prescription</p>
		</a>
	</div>
	<div class="prescriptionNo">
		<a class="btn btn-default" id="prescriptionNo">
			<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/ef63c33a.svg">
			<span id="downward-arrow">&#709;</span>
			<span id="upward-arrow" style="display: none;">&#707;</span>
			<p>Don't Have Prescription?</p>
		</a>
		<div id="prescriptionNo2">
			<ul>
				<li>Add medicines to your cart.</li>
    			<li>Select Free Doctor Consultation at checkout.</li>
			</ul>
			<a href="tel:+917696312581"><button class="btn call-btn"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/b5fa3098.svg"><span>Or Call On +91-7696312581</span></button></a>
		</div>
	</div>
</div>
</div>
	<div style="height: 20px;width: 100%;float: left;"></div>
<div class="container">
	<p style="font-size: 20px; margin: 40px 0px 20px 0px;font-weight: bold;width: 100%;">OFFERS</p>
	<div class="offer1" data-aos="fade-right" data-aos-duration="2000">
		<img src="https://d314ueg0lpx3nd.cloudfront.net/offer/13e28da3c0e-ff883fda5e7-8cb6aca7321-73c00e2e5dc-Myntra-13 (1).png">
		<p>Myntra Vouchers Rs.200</p>
		<span>Code:MYNTRA250</span>
	</div>
	<div class="offer2" data-aos="fade-up" data-aos-duration="2000">
		<img src="https://d314ueg0lpx3nd.cloudfront.net/offer/672765eb0d9-02 (2).png">
		<p>Rs.100 off on EAT.fit</p>
		<span>Code:EAT5</span>
	</div>
	<div class="offer3" data-aos="fade-down" data-aos-duration="2000">
		<img src="https://d314ueg0lpx3nd.cloudfront.net/offer/1bacc614d58-90dddc05abc-paytm-upi.jpg">
		<p>Flat 20% Cashback</p>
		<span>Code: PAYT20</span>
	</div>
	<div class="offer4" data-aos="fade-left" data-aos-duration="2000">
		<img src="https://d314ueg0lpx3nd.cloudfront.net/offer/2cba8563fe9-GROFFERS.png">
		<p>Rs.200 Grofers Gift Voucher</p>
		<span>Code:GR200</span>
	</div>
</div>
<div class="container">
	<p style="font-size: 20px; margin: 20px 0px;font-weight: bold;width: 100%;">What our customers have to say</p>
	<div class="review" data-aos="flip-left" data-aos-duration="2000">
		<p>Hiten Mehta, <span>Ghandinagar</span></p><br><br>
		<div><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/d29d41d8.svg" alt="quote"><br>
		Really amazing app, works smoothly and great service by these guys. Over and above all of that a 20% discount ! That's a complete wow factor right there. Almost my entire family uses this one now.. highly recommend to all.</div>
	</div>
	<div class="review" data-aos="flip-up" data-aos-duration="2000">
		<p>Akash Valia, <span>Mumbai</span></p><br><br>
		<div><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/d29d41d8.svg" alt="quote"><br>
		It's a super cool app with super discounts. Purchasing medicine became a so easy and discountable. It takes care of all my family medical needs.Very simple, smooth and useful.Do download and use it..</div>
	</div>
	<div class="review" data-aos="flip-right" data-aos-duration="2000">
		<p>Manish Verma, <span>Delhi</span></p><br><br>
		<div><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/d29d41d8.svg" alt="quote"><br>
		 PharmEasy has saved lots of time and money by delivering medicines at my home and also giving 20% discount. I always order medicines in the morning and by evening its delivered..... Too good and easy to use.</div>
	</div>
</div>
<hr>
<div class="container" style="margin-top: 20px;">
	<div class="reason1">
		<div class="reason1-image">
		<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/9ac2da37.svg">
		</div>
		<br>		
		<p>1 Lakh+ Products</p>
		<span>We maintain strict quality controls on all our partner retailers, so that you always get standard quality products.</span>
	</div>
	<div class="reason2">
		<div class="reason2-image">
		<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/a062dc91.svg">
		</div>
		<br>		
		<p>Monthly Refills</p>
		<span>Subscribe for monthly refills. Flat 20% OFF* and free home delivery.</span>
	</div>
	<div class="reason3">
		<div class="reason3-image">
		<img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/256fe591.svg">
		</div>
		<br>		
		<p>Easy Return</p>
		<span>30-day return policy for medicines and 2 days for Healthcare item(s). Refer FAQs section for more details.</span>
	</div>
</div>
<hr>
<div class="container" style="margin-top: 20px;margin-bottom: 40px;">
	<div class="screen-logo">
		<img src="images/5.png">
	</div>
	<div class="download-options">
		<span>Download the App for Free</span>
		<p>
			<button onclick="window.location.href = 'sry.php';" class="btn btn-ps"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/3380aedc.png">Google Play</button>
			<button onclick="window.location.href = 'sry.php';" class="btn btn-as"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/9bf5c576.png">Apple Store</button>
		</p>
	</div>
</div>

<?php include 'include/footer.php' ?>

<script type="text/javascript">


	$(document).ready(function(){
		$('#navbar-toggle-button').click(function(){
			$('#collapse-menu').slideToggle();
		});
		$('#prescriptionNo').click(function(){
			$('#prescriptionNo2').slideToggle();
			$('#downward-arrow').toggle();
			$('#upward-arrow').toggle();

		});

	});
	AOS.init();
	 function login() {
            document.getElementById('main-div2').style.display="block";
            document.getElementById('main-div1').style.display="block";
            document.getElementById("overlay").style.display = "block";
            document.getElementById("home").style.overflow = "hidden";

        }
        function off() {
	        document.getElementById("overlay").style.display = "none";
	        document.getElementById('main-div1').style.display="none";
	        document.getElementById('main-div2').style.display="none";
	        document.getElementById("home").style.overflow = "auto";
        }

</script>
</body>
</html>