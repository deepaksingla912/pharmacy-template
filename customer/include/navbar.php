<nav class="navbar navbar-fixed-top menu-nav" id="menu-nav" style="z-index: 2">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" id="navbar-toggle-button">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<div class="navbar-brand" onclick="window.location.href = 'index.php';">MED-OCTOR</div>
		</div>
		<div class="nav navbar-nav navbar-right navbar-menu">
			<li id="signinlogin2"><a onclick="login()"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/c113c212.svg">Sign Up/Login</a></li>
			<li id="profile2" class="dropdown"><a data-toggle="dropdown"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/c113c212.svg">Profile
				<ul class="dropdown-menu" style="background-color: #10847e;">
				<li><a href="profile.php">Profile</a></li>
				<li><a href="prescription_status.php">My Prescriptions</a></li>
				<li><a href="orders.php">Orders</a></li>
				<li><a href="logout.php">LogOut</a></li>
				</ul>

			</a></li>
      		<li><a href="wishlist.php"><span class="glyphicon glyphicon-heart"></span>Wishlist</a></li>
      		<li><a href="cart.php"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/962c1326.svg">Cart</a></li>
		</div>
		<div class="nav navbar-nav navbar-right collapse-menu" id="collapse-menu">
			<li id="signinlogin1"><a onclick="login()"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/c113c212.svg">Sign Up/Login</a></li>
			<li id="profile1" data-toggle="collapse" data-target="#qaz"><a><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/c113c212.svg">Profile</a></li>
			<ul class="collapse" id="qaz" style="background-color: #2fa39b;">
				<li><a href="profile.php">Profile</a></li>
				<li><a href="prescription_status.php">My Prescriptions</a></li>
				<li><a href="orders.php">Orders</a></li>
				<li><a href="logout.php">LogOut</a></li>
				</ul>
      		<li><a href="wishlist.php"><span class="glyphicon glyphicon-heart"></span>Wishlist</a></li>
      		<li><a href="cart.php"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/962c1326.svg">Cart</a></li>
		</div>
	</div>
</nav>