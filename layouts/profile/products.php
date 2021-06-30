<?php
// get all users

$products = get_all_products();

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

<h3>Products</h3>
<?php
//var_dump($products);
if ($products)
foreach($products as $product ){
    //var_dump($product);
    $image_src= ( $product['image'] || is_file('../Auth/uploads/'.$product['image']) ) ? '../Auth/uploads/'.$product['image']:
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
						<?=$product['name']?>				</div>
					<div class="profile-usertitle-job">
						<?=$product['cat_name']?>		
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<a type="button" href="./profile?view=add_product&id=<?=$product['ID']?>" class="btn btn-success btn-sm " style="color:#fff">Edit</a>
					<button type="button" class="btn btn-danger btn-sm remove-products" data-class="<?=$product['ID']?>">Delete</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				
				<!-- END MENU -->
			</div>

    
    
    
<?php } ?>
