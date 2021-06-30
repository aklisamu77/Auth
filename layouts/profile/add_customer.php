   <!-- -->
   <?php
   // check auth
   $editUser = array();
   // check edit or add
   if (isset($_GET['id'])){
      $user_id = $_GET['id'];
       if ( (get_user_role() == 'super-admin') ||
           (get_user_role() == 'admin' && get_user_role($user_id) == 'user' ) ){
            // get user info
            $editUser = new User($user_id);
            //$query = "select * from users where ID = '".$user_id."'";
            //$res = mysqli_query($con ,$query);
            if ($editUser->get_ID() == false) {
               echo 'No User By That ID';
               die ;
            }  else {
               $edit_role = $editUser->get_role();
               $edit_id = $editUser->get_ID();
               $editUser = (array) $editUser;
            }
                //var_dump($editUser);
       }
      
      
   }
   // <?=(isset($editUser['']))?$editUser['']:''
   ?>
   <style>
    

.form-holder {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      min-height: 100vh;
}

.form-holder .form-content {
    position: relative;
    text-align: center;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-align-items: center;
    align-items: center;
    padding: 60px;
}

.form-content .form-items {
    border: 3px solid #fff;
    padding: 40px;
    display: inline-block;
    width: 100%;
    min-width: 540px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    text-align: left;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
}

.form-content h3 {
    color: #fff;
    text-align: left;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 5px;
}

.form-content h3.form-title {
    margin-bottom: 30px;
}

.form-content p {
    color: #fff;
    text-align: left;
    font-size: 17px;
    font-weight: 300;
    line-height: 20px;
    margin-bottom: 30px;
}

.form-items{
    background: #9C9BD4;
}
.form-content label, .was-validated .form-check-input:invalid~.form-check-label, .was-validated .form-check-input:valid~.form-check-label{
    color: #fff;
}

.form-content input[type=text], .form-content input[type=password], .form-content input[type=email], .form-content select {
    width: 100%;
    padding: 9px 20px;
    text-align: left;
    border: 0;
    outline: 0;
    border-radius: 6px;
    background-color: #fff;
    font-size: 15px;
    font-weight: 300;
    color: #8D8D8D;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    margin-top: 16px;
}


.btn-primary{
    background-color: #6C757D;
    outline: none;
    border: 0px;
     box-shadow: none;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active{
    background-color: #495056;
    outline: none !important;
    border: none !important;
     box-shadow: none;
}

.form-content textarea {
    position: static !important;
    width: 100%;
    padding: 8px 20px;
    border-radius: 6px;
    text-align: left;
    background-color: #fff;
    border: 0;
    font-size: 15px;
    font-weight: 300;
    color: #8D8D8D;
    outline: none;
    resize: none;
    height: 120px;
    -webkit-transition: none;
    transition: none;
    margin-bottom: 14px;
}

.form-content textarea:hover, .form-content textarea:focus {
    border: 0;
    background-color: #ebeff8;
    color: #8D8D8D;
}

.mv-up{
    margin-top: -9px !important;
    margin-bottom: 8px !important;
}

.invalid-feedback , .exist-feedback{
    color: #fff;
    border-left: 3px solid red;
    padding-left: 10px;
}

.valid-feedback, .exist-feedback{
   color: #2acc80;
}
.exist-feedback {
    color: #fff;
    display: none;
}
   </style>
   <!--     - image  -->
   <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>
                           <?=isset($edit_id)?'Edit User ':'Register New User'?>
                        </h3>
                        
                        <form class="requires-validation" novalidate action="./actions/add_customer.php"
                              method="post" enctype="multipart/form-data">
                           <?php if (isset($edit_id)) { ?>
                           <input class="form-control" type="hidden" readonly="readonly" name="edit_id"
                                  required value="<?=$edit_id?>">
                               
                           <?php } ?>
                            <div class="col-md-12">
                               <input class="form-control" type="text" name="name" placeholder="Full Name"
                                      value="<?=(isset($editUser['name']))?$editUser['name']:''?>" required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Full Name field cannot be blank or contain numbers!</div>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="email" name="email" placeholder="E-mail Address"
                                       value="<?=(isset($editUser['email']))?$editUser['email']:''?>" required>
                                 <div class="valid-feedback">Email field is valid!</div>
                                 <div class="invalid-feedback">Email field cannot be blank or not Email!</div>
                                 <div class="exist-feedback">Email is already exist kindly choose another email!</div>
                            </div>
                            <div class="col-md-12">
                               <input class="form-control" type="text" name="phone" placeholder="Mobile Phone"
                                      value="<?=(isset($editUser['mobile']))?$editUser['mobile']:''?>" required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">mobile field cannot be blank or contain string or not 11 numbers!</div>
                              <div class="exist-feedback">mobile is already exist kindly choose another mobile!</div>
                            </div>
                           <!-- only if super admin -->
                           <?php if (get_user_role() == 'super-admin') {
                                    
                              ?> 
                           <div class="col-md-12">
                                <select class="form-control form-select mt-3" name ="role" required>
                                      <option selected disabled value="">Role</option>
                                      <option value="super-admin"
                                           <?=(isset($edit_role) && $edit_role =='super-admin')?'selected':''?>>Super Admin</option>
                                      <option value="admin"
                                      <?=(isset($edit_role) && $edit_role =='admin')?'selected':''?>>Admin</option>
                                      <option value="user"
                                         <?=(isset($edit_role) && $edit_role =='user')?'selected':''?>>Customer</option>
                               </select>
                                <div class="valid-feedback">You selected a position!</div>
                                <div class="invalid-feedback">Please select a position!</div>
                           </div>
                           <?php } ?>

                           <div class="col-md-12">
                              <input class="form-control" type="password" name="password" placeholder="Password" required>
                               <div class="valid-feedback">Password field is valid!</div>
                               <div class="invalid-feedback">Password field cannot be blank!</div>
                           </div>
                           <div class="col-md-12">
                              <input class="form-control" type="password" name="c-password" placeholder="Confirm Password"
                                     required>
                               <div class="valid-feedback">Password field is valid!</div>
                               <div class="invalid-feedback">Password field cannot be blank or not equal password!</div>
                           </div>
                           <br>
                            <div class="col-md-12">
                               <input class="form-control" type="file" name="image" placeholder="Image"
                                      required>
                               <?php if (isset($editUser['image'])) { ?>
                               <img src="<?=$editUser['image']?>" style=" margin: 10px; width: 200px; height: auto; ">
                               <?php } ?>
                               <div class="invalid-feedback">Image field cannot be blank or not JPG/PNg or more than 1 mega!</div>
                            </div>

              

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Register</button>
                                <span class="alert alert-success success-add" style="display:none">Succesfully Add New User</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
   
