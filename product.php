<?php require('./includes/defines.php') ?>
<?php require('./layouts/header.php') ?>

<?php
// get product info
if (isset($_GET['id'])) $user_id = intval($_GET['id']);
else {
   echo 'No Product By That ID';
   die ;
}
if (!$product = get_all_products('p.ID = '.$user_id) ){
    
    echo 'No Product By That ID';
   die ;
} else {
    
    $product= $product[0];
        // get albume images
         $query = "select * from product_album where product_id = '".$user_id."'";
         $res_album = mysqli_query($con ,$query);
         $albume_src= array();
         if ($res_album->num_rows != 0)
            while($row = mysqli_fetch_assoc($res_album))
                  $albume_src[] = $row;   
}

if ( $product['image'] || is_file('../Auth/uploads/'.$product['image']) ){
$src = '../Auth/uploads/'.$product['image'];

}
else $src = 'https://cdn2.iconfinder.com/data/icons/avatars-99/62/avatar-370-456322-512.png';



?>

<!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <img src="<?=$src?>" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

            <div class="mb-3">
              <a href="<?=$defines['site_url']?>category?id=<?=$product['cat_id']?>">
                <span class="badge purple mr-1"><?=$product['cat_name']?></span>
              </a>
              
            </div>

            <p class="lead">
                <?php if ($product['sale-price']!=0) { ?>
                  <span class="saled"><del><?=$product['price']?>$</del></span>
                  <span><?=$product['sale-price']?>$</span>
                  <?php } else { ?>
                  <span><?=$product['price']?>$</span>
                  <?php }  ?>
              
            </p>

            <p class="lead font-weight-bold">Description</p>

            <p><?=$product['description']?></p>

            <form class="d-flex justify-content-left">
              <!-- Default input -->
              <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">
              <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Additional Iamges</h4>
        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <?php if ($albume_src) foreach ($albume_src as $album) { ?>
        <div class="col-lg-4 col-md-12 mb-4">

          <img src="<?='../Auth/uploads/'.$album['image']?>" class="img-fluid" alt="">

        </div>
        <?php } else { ?>
        No Additional Images 
        <?php }  ?>

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->


<?php require('./layouts/footer.php') ?>