<?php require('./includes/defines.php') ?>
<?php require('./layouts/header.php') ?>
<?php
// get all cats
   if (isset($_GET['id'])) $user_id = intval($_GET['id']);
   else {
     echo 'No category By That ID';
       die ;
   }
   // get user info
    $query = "select * from category where ID = '".$user_id."'";
    $res = mysqli_query($con ,$query);
    if ($res->num_rows == 0) {
       echo 'No category By That ID';
       die ;
    }  else 
            $category = mysqli_fetch_assoc($res);
            
    $category['childs'] = get_categories(' = '.$category['ID']);
    
    $image_src= '../Auth/uploads/'.$category['image'];
// products
$products = get_all_products('p.parent = '.$user_id);
//var_dump($products);
?>
<div class="banner" style="background-image:url('<?=$image_src?>')">
    
    <span><?=$category['name']?></span>
    
</div>
<br><br><br>
<div class="container">
<div class="row child_cats">
<?php if ($category['childs']) foreach($category['childs'] as $child) { ?>
    <div class="col-md-3"><a href="<?=$defines['site_url']?>category?id=<?=$child['ID']?>"><?=$child['name']?></a></div>
<?php } ?>
</div>

<br><br><br>
<div class="row description">
    <div class="col-md-8 offset-md-2">
        <section class="blockquote-section">
                <blockquote class="classy-bq"><p><?=$category['description']?></blockquote>
        </section>
  </div>
<br>
<br>
<br>
</div>
<div class="text-center mb-4">
<div class="row">
<?php foreach($products as $product ) {
    $image_src_prod =  ( $product['image'] || is_file('../Auth/uploads/'.$product['image']) ) ? '../Auth/uploads/'.$product['image']:
                    'https://cdn2.iconfinder.com/data/icons/avatars-99/62/avatar-370-456322-512.png';
    
    ?>
<div class="col-lg-3 col-md-6 mb-4">

            <!--Card-->
            <div class="card">
  <a href="<?=$defines['site_url']?>product?id=<?=$product['ID']?>">
              <!--Card image-->
              <div class="view overlay">
                <img src="<?=$image_src_prod?>" class="card-img-top"
                  alt="">
                
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center">
                <!--Category & Title-->
                <a href="<?=$defines['site_url']?>category?id=<?=$product['cat_id']?>" class="grey-text">
                  <h5><?=$product['cat_name']?></h5>
                </a>
                <h5>
                  <strong>
                    <a href="<?=$defines['site_url']?>product?id=<?=$product['ID']?>" class="dark-grey-text"><?=$product['name']?>	
                      <span class="badge badge-pill danger-color">NEW</span>
                    </a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold blue-text">
                  
                  <?php if ($product['sale-price']!=0) { ?>
                  <strong class="saled"><?=$product['price']?>$</strong>
                  <strong><?=$product['sale-price']?>$</strong>
                  <?php } else { ?>
                  <strong><?=$product['price']?>$</strong>
                  <?php }  ?>
                </h4>

              </div>
              <!--Card content-->
</a>
            </div>
            <!--Card-->

          </div>
          

<?php } ?>
</div>
</div>
</div>
</div>

<?php require('./layouts/footer.php') ?>