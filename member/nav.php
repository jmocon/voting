<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/UserModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
//$clsUser = new User();
//$clsUser->CheckSession('admin');

$userName = $clsUser->GetNameById($_SESSION['uid']);
// $mdlImage = new ImageModel();
// $lstImage = $clsImage->GetByDetail("user",$_SESSION['uid'],"30");
// foreach($lstImage as $mdlImg){
// 	$mdlImage = $mdlImg;
// }
?>
<head>
<style>
.avatar img{
	width: auto !important;
}
</style>
</head>
		<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

			<div class="navbar-header">
				<a href="index.php" class="navbar-brand navbar-brand-center">
					<img class="navbar-brand-logo" src="../<?php echo $clsContent->GetLogo(); ?>" title="<?php echo $clsContent->GetName(); ?>">
					<span class="navbar-brand-text hidden-xs-down" style="font-size:16px;"> <?php echo $clsContent->GetName(); ?></span>
				</a>
			</div>

			<div class="navbar-container container-fluid">
				<!-- Navbar Collapse -->
				<div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">

					<!-- Navbar Toolbar Right -->
					<ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
						<li class="nav-item vertical-align">
							<h6 class="vertical-align-middle"><?php echo $userName; ?></h6>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
								<span class="avatar avatar-online">
									<?php
									$lstImage = $clsImage->GetByDetail("user",$mdlUser->getId(),"30");
									foreach($lstImage as $mdlImage){ ?>
										<img src="<?php echo "../" . $clsImage->ToLocation($mdlImage); ?>" class="img-fluid img-bordered" />
									<?php
									}
									?>
									<i></i>
								</span>
							</a>
							<div class="dropdown-menu" role="menu">
								<a class="dropdown-item" href="ViewProfile.php" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
								<div class="dropdown-divider" role="presentation"></div>
								<a class="dropdown-item" href="../logout.php" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
							</div>
						</li>
					</ul>
					<!-- End Navbar Toolbar Right -->
				</div>
				<!-- End Navbar Collapse -->

			</div>
		</nav>
