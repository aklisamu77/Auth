<?php
// get all users
global $con;
$str ='';

$users = User::get_all($current_user->get_role());
//var_dump($users);
?>

<style>
    .profile-sidebar.single-customer {
    display: inline-block;
    width: 30%;
    background: #eee;
    border-radius: 6px;
    margin: 1%;
    float: left;
    height: 260px;
}
</style>

<h3>Customers</h3>
<?php
//var_dump($users);
if ($users)
foreach($users as $user ){
    //var_dump($user);
    $image_src= ( $user['image'] || is_file('../Auth/uploads/'.$user['image']) ) ? '../Auth/uploads/'.$user['image']:
                    'https://cdn2.iconfinder.com/data/icons/avatars-99/62/avatar-370-456322-512.png';
    
    ?>
    <div class="profile-sidebar single-customer">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                    					<img src="<?=$image_src?>" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?=$user['name']?>				</div>
					<div class="profile-usertitle-job">
						<?=$user['role']?>		
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<a type="button" href="./profile?view=add_customer&id=<?=$user['ID']?>" class="btn btn-success btn-sm " style="color:#fff">Edit</a>
					<button type="button" class="btn btn-danger btn-sm remove-user" data-class="<?=$user['ID']?>">Delete</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				
				<!-- END MENU -->
			</div>

    
    
    
<?php } ?>
