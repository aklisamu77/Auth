<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Auth/classes/user.php');
require('./includes/defines.php');

$current_user = new User($_SESSION['user']);
if ( $current_user->get_ID() == false ) header("location:".$defines['site_url']."login");
?>
<?php require('./layouts/header.php') ?>
<?php

//$current_user = get_user_login('redirect');

//var_dump( $current_user->get_ID() );
//die ;

?>
<div class="container">
    
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                    <img src="<?=$current_user->image?>" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?=$current_user->name?>
					</div>
					<div class="profile-usertitle-job">
						<?=$current_user->get_role()?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Tasks </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
                    
                    <?php
                    if (isset($_GET['view']) )
                        if (is_file('./layouts/profile/'.$_GET['view'].'.php'))
                            include ('./layouts/profile/'.$_GET['view'].'.php');
                        else echo 'File Not Exist';
                    else include ('./layouts/profile/content.php');
                    ?>
			   
            </div>
		</div>
	</div>
</div>

<br>
<br>

<?php require('./layouts/footer.php') ?>