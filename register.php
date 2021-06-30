<?php

require('./includes/defines.php') ?>
<?php require('./layouts/header.php') ?>

<?php

if (isset($_SESSION['user']) && !empty($_SESSION['user']) ){
    header("location:./profile");
}
?>
<br>
<br>
<br><br>
<br>
<link href="./assets/rgist.css" rel="stylesheet" id="regist-css">
<h3 class="text-center">Register New Account </h3>
<div class="container" <?=$strings['container_rtl']?> >
    <div class="row">
        <div class="col-md-4 offset-md-4">

  <form class="requires-validation front-form" novalidate action="./actions/add_customer.php"
                              method="post" enctype="multipart/form-data">
                           
                            <div class="col-md-12 my-2">
                               <input class="form-control" type="text" name="name" placeholder="Full Name"
                                       required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Full Name field cannot be blank or contain numbers!</div>
                            </div>

                            <div class="col-md-12 my-2">
                                <input class="form-control" type="email" name="email" placeholder="E-mail Address"
                                       value="<?=(isset($editUser['email']))?$editUser['email']:''?>" required>
                                 <div class="valid-feedback">Email field is valid!</div>
                                 <div class="invalid-feedback">Email field cannot be blank or not Email!</div>
                                 <div class="exist-feedback">Email is already exist kindly choose another email!</div>
                            </div>
                            <div class="col-md-12 my-2">
                               <input class="form-control" type="text" name="phone" placeholder="Mobile Phone"
                                      value="<?=(isset($editUser['mobile']))?$editUser['mobile']:''?>" required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">mobile field cannot be blank or contain string or not 11 numbers!</div>
                              <div class="exist-feedback">mobile is already exist kindly choose another mobile!</div>
                            </div>
                           <!-- only if super admin -->
                           

                           <div class="col-md-12 my-2">
                              <input class="form-control" type="password" name="password" placeholder="Password" required>
                               <div class="valid-feedback">Password field is valid!</div>
                               <div class="invalid-feedback">Password field cannot be blank!</div>
                           </div>
                           <div class="col-md-12 my-2">
                              <input class="form-control" type="password" name="c-password" placeholder="Confirm Password"
                                     required>
                               <div class="valid-feedback">Password field is valid!</div>
                               <div class="invalid-feedback">Password field cannot be blank or not equal password!</div>
                           </div>
                           <br>
                            <div class="col-md-12 my-2 ">
                               <input class="form-control" type="file" name="image" placeholder="Image"
                                      required>
                               <?php if (isset($editUser['image'])) { ?>
                               <img src="<?='../Auth/uploads/'.$editUser['image']?>" style=" margin: 10px; width: 200px; height: auto; ">
                               <?php } ?>
                               <div class="invalid-feedback">Image field cannot be blank or not JPG/PNg or more than 1 mega!</div>
                            </div>

              

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Register</button>
                                <div class="alert alert-success success-add" style="display:none">Succesfully Add New User</div>
                            </div>
                        </form>
                   

</div>
    </div>
</div>
<?php require('./layouts/footer.php') ?>