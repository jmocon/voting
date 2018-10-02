<head>
	<style>
		.site-menubar {
			position: absolute !important;
			z-index:1 !important;
		}
		.site-navbar {
			background-image: url("assets/images/navbg.png");
			background-repeat: repeat-x;
			background-size: auto 70px;
		}
		.building {
			background-image: url("assets/images/navbuild.png");
			background-repeat: no-repeat;
			background-size: 100% 100%;
			position: absolute;
			top: 0;
			right:0;
			z-index:3;
			height: 150px;
			width: 225px;
		}
	</style>
</head>

<nav class="site-navbar navbar navbar-default navbar-mega" role="navigation">

	<div class="navbar-header">
		<button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
			data-toggle="menubar">
			<span class="sr-only">Toggle navigation</span>
			<span class="hamburger-bar"></span>
		</button>
		<a class="navbar-brand navbar-brand-center" href="index.php" style="padding-top:5px; padding-left:20px;">
			<img class="navbar-brand-logo navbar-brand-logo-normal" src="<?php echo $clsContent->GetLogo(); ?>" title="<?php echo $clsContent->GetName(); ?>">
			<img class="navbar-brand-logo navbar-brand-logo-special" src="<?php echo $clsContent->GetLogo(); ?>" title="<?php echo $clsContent->GetName(); ?>" style="height:66px;">
		</a>
	</div>

	<div class="navbar-container container-fluid" style="padding-right: 200px;">
		<!-- Navbar Collapse -->
		<div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
			<!-- Navbar Toolbar -->
			<ul class="nav navbar-toolbar">
				<li class="nav-item hidden-float" id="toggleMenubar">
					<a class="nav-link" data-toggle="menubar" href="#" role="button">
						<i class="icon hamburger hamburger-arrow-left">
							<span class="sr-only">Toggle menubar</span>
							<span class="hamburger-bar"></span>
						</i>
					</a>
				</li>
			</ul>
			<!-- End Navbar Toolbar -->

			<!-- Navbar Toolbar Right -->
			<ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
				<li class="nav-item">
					<a class="nav-link">
						<i class="site-menu-icon glyphicon glyphicon-earphone" style="font-size:20px;" aria-hidden="true"></i>
						<strong style="font-size: 25px;" >+63 917-9320-145</strong>
					</a>
				</li>
			</ul>
			<!-- End Navbar Toolbar Right -->
		</div>
		<!-- End Navbar Collapse -->
		
	</div>
</nav>

<div class="building d-none d-lg-block"></div>

<div class="site-menubar">
	<div class="site-menubar-body">
		<ul class="site-menu" data-plugin="menu">
			<li class="site-menu-category">General</li>
			<li class="dropdown site-menu-item active">
				<a href="index.php">
					<span class="site-menu-title">Home</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="post.php?Purpose_Id=1">
					<span class="site-menu-title">Buy</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="post.php?Purpose_Id=2">
					<span class="site-menu-title">Sell</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="post.php?Purpose_Id=3">
					<span class="site-menu-title">Lease</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="#">
					<span class="site-menu-title">About Us</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="developerlist.php">
					<span class="site-menu-title">Developers</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="agents.php">
					<span class="site-menu-title">Agents</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="partnerlist.php">
					<span class="site-menu-title">Partners</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="contactus.php">
					<span class="site-menu-title">Contact Us</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="register.php">
					<span class="site-menu-title">Sign Up</span>
				</a>
			</li>
			<li class="dropdown site-menu-item ">
				<a href="login.php">
					<span class="site-menu-title">Login</span>
				</a>
			</li>
			<!-- References
			<li class="dropdown site-menu-item has-sub">
				<a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
					<i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
					<span class="site-menu-title">Pages</span>
					<span class="site-menu-arrow"></span>
				</a>
				<div class="dropdown-menu">
					<div class="site-menu-scroll-wrap is-list">
						<ul class="site-menu-sub site-menu-normal-list">
							<li class="site-menu-item has-sub">
								<a href="javascript:void(0)">
									<span class="site-menu-title">Errors</span>
									<span class="site-menu-arrow"></span>
								</a>
								<ul class="site-menu-sub">
									<li class="site-menu-item">
										<a class="animsition-link" href="pages/error-400.html">
											<span class="site-menu-title">400</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</li>
			-->
		</ul>
	</div>
</div>
					
					
					