   <!-- -->
   <?php
   // get all cats
   $categories = get_categories();
   foreach($categories as $key => $value){
    
        $categories[$key]['childs'] = get_categories(' = '.$value['ID']);
   }
   //echo '<pre>'; var_dump($categories);
   // check auth
   $editUser = array();
   // check edit or add
   if (isset($_GET['id'])){
      $user_id = $_GET['id'];
       if ( get_user_role() == 'super-admin' || get_user_role() == 'admin'  ){
            // get user info
            $query = "select * from products where ID = '".$user_id."'";
            $res = mysqli_query($con ,$query);
            if ($res->num_rows == 0) {
               echo 'No Product By That ID';
               die ;
            }  else {
                    $editUser = mysqli_fetch_assoc($res);
                    // get albume images
                     $query = "select * from product_album where product_id = '".$user_id."'";
                     $res_album = mysqli_query($con ,$query);
                     $albume_src= array();
                     if ($res_album->num_rows != 0)
                        while($row = mysqli_fetch_assoc($res_album))
                              $albume_src[] = $row;   
            }
                
       }
      
      
   }
   // <?=(isset($editUser['']))?$editUser['']:''
   ?>
   <style>
    
.album_element {
    display: inline-block;
    width: 30%;
    overflow: hidden;
    vertical-align: text-top;
    height: 86px;
    position: relative;
    margin: 1%;
}
.album_element .fa-trash {
    position: absolute;
    top: 0;
    left: 0;
    color: red;
    background: rgba(0,0,0,0.4);
    width: 100%;
    height: 100%;
    padding: 20% 50%;
    display: none;
    cursor: pointer;
}
.album_element img{
   margin: 0;
    width: 100%;
    height: 100%;
}
.album_element:hover .fa-trash{
   display: block;
}
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
                           <?=isset($editUser['ID'])?'Edit Product ':'Add New Product'?>
                        </h3>
                        
                        <form class="create-product" novalidate action="./actions/add_customer.php"
                              method="post" enctype="multipart/form-data">
                           <?php if (isset($editUser['ID'])) { ?>
                           <input class="form-control" type="hidden" readonly="readonly" name="edit_id"
                                  required value="<?=$editUser['ID']?>">
                               
                           <?php } ?>
                            <div class="col-md-12">
                               <input class="form-control" type="text" name="name" placeholder="Product Name"
                                      value="<?=(isset($editUser['name']))?$editUser['name']:''?>" required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Name field cannot be blank or contain numbers!</div>
                               <div class="exist-feedback">Name field cannot be replecated!</div>
                            </div>
                            
                            <div class="col-md-12">
                               <input class="form-control" type="text" name="price" placeholder="Product price"
                                      value="<?=(isset($editUser['price']))?$editUser['price']:''?>" required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">price field cannot be blank or contain chars!</div>
                               <div class="exist-feedback">Name field cannot be replecated!</div>
                            </div>
                            
                            <div class="col-md-12">
                               <input class="form-control" type="text" name="sale-price" placeholder="Sale price"
                                      value="<?=(isset($editUser['sale-price']))?$editUser['sale-price']:''?>" required>
                               <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Sale price field contain chars!</div>
                               <div class="exist-feedback">Name field cannot be replecated!</div>
                            </div>

                            <div class="col-md-12">
                                <select class="form-control form-select mt-3" name ="parent" required>
                                      <!--<option value="null"
                                           <?=(isset($editUser['parent']) && $editUser['parent'] =='null')?'selected':''?>>No parent</option>-->
                                    <?php foreach($categories as $parent_cat) { ?>
                                    <option value="<?=$parent_cat['ID']?>"
                                           <?=(isset($editUser['parent']) && $editUser['parent'] ==$parent_cat['ID'])?'selected':''?>>
                                           <?=$parent_cat['name']?></option>
                                    
                                    <?php if ($parent_cat['childs']) foreach($parent_cat['childs'] as $child_cat) { ?>
                                    <option value="<?=$child_cat['ID']?>" class="chld" disabled="disabled"
                                           <?=(isset($editUser['parent']) && $editUser['parent'] ==$child_cat['ID'])?'selected':''?>>
                                           -- <?=$child_cat['name']?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                                <div class="valid-feedback">You selected a position!</div>
                                <div class="invalid-feedback">Please select a position!</div>
                           </div>
                           <br>
                            <div class="col-md-12">
                                <label>Main Image</label>
                               <input class="form-control" type="file" name="image" placeholder="Image"
                                      required>
                               <?php if (isset($editUser['image'])) { ?>
                               <img src="<?='../Auth/uploads/'.$editUser['image']?>" style=" margin: 10px; width: 200px; height: auto; ">
                               <?php } ?>
                               <div class="invalid-feedback">Image field cannot be blank or not JPG/PNg or more than 1 mega!</div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <label>More Images</label>
                               <input class="form-control" type="file" multiple name="more-images[]" placeholder="Image"
                                      required>
                               <?php if (isset($editUser['image'])) foreach ($albume_src as $album) { ?>
                               <div class="album_element" data-class="<?=$album['ID']?>">
                                 <i class="fa fa-trash" ></i>
                                 <img src="<?='../Auth/uploads/'.$album['image']?>" style="  ">
                               </div>
                               <?php } ?>
                               <input type="hidden" name="remove_albume_element">
                               <div class="invalid-feedback">Image field cannot be blank or not JPG/PNg or more than 1 mega!</div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <textarea class="form-control"  name="description" placeholder="Product Description"
                                ><?=(isset($editUser['description']))?$editUser['description']:''?></textarea>
                                <div class="invalid-feedback">Description cannot be empty!</div>
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
   
   
