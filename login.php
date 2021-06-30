<?php

require('./includes/defines.php') ?>
<?php require('./layouts/header.php') ?>

<?php

if (isset($_SESSION['user']) && !empty($_SESSION['user']) ){
    header("location:./profile");
}
?>

<div class="container" <?=$strings['container_rtl']?> >
    <div class="row">
        <div class="col-md-4 offset-md-4">
<form class="form-signin" method="post" action="./actions/login.php">
      <img class="mb-4" src="https://getbootstrap.com/docs/4.1/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal"><?=$strings['Please sign in']?></h1>
      <?php
      if (isset($_GET['error'])) {
            if (isset($defines[$_GET['error']])) {  ?>
                <div class="alert alert-danger"><?=$defines[$_GET['error']]?> </div>
            <?php } else { ?>
                <div class="alert alert-danger"><?=$strings['Error']?> </div>
            <?php }
      
      } ?>
      
      <label for="inputEmail" class="sr-only"><?=$strings['Email address']?></label>
      <input type="text" id="inputEmail" class="form-control" placeholder="<?=$strings['Email address / Mobile']?>" required=""
             autofocus="" name="email">
      <label for="inputPassword" class="sr-only"><?=$strings['Password']?></label>
      <input type="password" id="inputPassword" class="form-control" placeholder="<?=$strings['Password']?>" required=""
                name="password" >
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="1" name="remmeber"> <?=$strings['Remember me']?>
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit"><?=$strings['Sign in']?></button>
      
    </form>

</div>
    </div>
</div>
<?php require('./layouts/footer.php') ?>