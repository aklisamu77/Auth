<!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
        <i class="fab fa-youtube mr-3"></i>
      </a>

      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
        <i class="fab fa-google-plus-g mr-3"></i>
      </a>

      <a href="https://dribbble.com/mdbootstrap" target="_blank">
        <i class="fab fa-dribbble mr-3"></i>
      </a>

      <a href="https://pinterest.com/mdbootstrap" target="_blank">
        <i class="fab fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>

      <a href="http://codepen.io/mdbootstrap/" target="_blank">
        <i class="fab fa-codepen mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

<!-- footer  -->
<!-- JQuery -->
  <script type="text/javascript" src="./assets/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="./assets/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="./assets/js/mdb.min.js"></script>
<!--
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script type="text/javascript" src="./assets/mdb.min.js"></script>-->
<script>
    $= jQuery ; 
    jQuery(document).ready(function() {
    jQuery(".dropdown-toggle").dropdown();
});
    
    // Animations initialization
    new WOW().init();

  
</script>
  <script>
    (function () {
'use strict'
const forms = document.querySelectorAll('.requires-validation')
Array.from(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      //form.classList.add('was-validated')
    }, false)
  });
  // carosal
  
  
        jQuery('.requires-validation').on('submit', function (e) {

         jQuery('.invalid-feedback').fadeOut();
         jQuery('.exist-feedback').fadeOut();
         jQuery('.success-add').fadeOut();
        e.preventDefault();
    var formData = new FormData(this);
    formData.append('action','new_customers');
$.ajax({
        url: './actions/add_new2.php', // try 2
        type: 'POST',
        data: formData,
        dataType: "JSON",
        success: function (data) {
            //alert(data.stat);
            
            if (data.stat == 'error'){
                //alert(data.element +' == '+data.error);
                //console.log(data.validate);
                for (const key in data.validate) {
                   //console.log(`${key}: ${data.validate[key]}`);
                   var elm = jQuery('.form-control[name='+key+']').parent('.col-md-12').find('.invalid-feedback');
                   elm.text(data.validate[key]);
                   elm.fadeIn();
                   //jQuery('.form-control[name='+key+']').parent('.col-md-12').find('.'+data.validate[key]).fadeIn();
            
                }
               jQuery('.form-control[name='+data.element+']').parent('.col-md-12').find('.'+data.error).fadeIn();
            } else if (data.stat == 'success'){
              if (!jQuery('input[name=edit_id]').length)
              jQuery('.requires-validation').find("input[type=text], textarea, input[type=email],input[type=password],select,input[type=file]").val("");
                jQuery('.success-add').html(data.message);
                jQuery('.success-add').fadeIn();
                
            }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });
/*    $.post('./actions/add_new.php', formData, function(data) {
        alert(data);
    });*/
return false ;
        });
 /* create new category */
 jQuery('.create-category').on('submit', function (e) {

        jQuery('.invalid-feedback').fadeOut();
        jQuery('.exist-feedback').fadeOut();
        jQuery('.success-add').fadeOut();
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action','new_category');
$.ajax({
        url: './actions/add_cat.php',
        type: 'POST',
        data: formData,
        dataType: "JSON",
        success: function (data) {
            //alert(data.stat);
            
            if (data.stat == 'error'){
                //alert(data.element +' == '+data.error);
        jQuery('.form-control[name='+data.element+']').parent('.col-md-12').find('.'+data.error).fadeIn();
            } else if (data.stat == 'success'){
              if (!jQuery('input[name=edit_id]').length)
              jQuery('.create-category').find("input[type=text], textarea, input[type=email],input[type=password],select,input[type=file]").val("");
                jQuery('.success-add').html(data.message);
                jQuery('.success-add').fadeIn();
                
            }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });
/*    $.post('./actions/add_new.php', formData, function(data) {
        alert(data);
    });*/
return false ;
        });
        
  /* create new product */
 jQuery('.create-product').on('submit', function (e) {

        jQuery('.invalid-feedback').fadeOut();
        jQuery('.exist-feedback').fadeOut();
        jQuery('.success-add').fadeOut();
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action','new_product');
$.ajax({
        url: './actions/add_product.php',
        type: 'POST',
        data: formData,
        dataType: "JSON",
        success: function (data) {
            //alert(data.stat);
            
            if (data.stat == 'error'){
                //alert(data.element +' == '+data.error);
        jQuery('.form-control[name='+data.element+']').parent('.col-md-12').find('.'+data.error).fadeIn();
            } else if (data.stat == 'success'){
              if (!jQuery('input[name=edit_id]').length)
              jQuery('.create-product').find("input[type=text], textarea, input[type=email],input[type=password],select,input[type=file]").val("");
                jQuery('.success-add').html(data.message);
                jQuery('.success-add').fadeIn();
                
            }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });
/*    $.post('./actions/add_new.php', formData, function(data) {
        alert(data);
    });*/
return false ;
        });
        
  /* enf fn */
})()

/* remove user */
jQuery('.remove-user').click(function(){
    var formData = new FormData();
    formData.append('action','remove_user');
    formData.append('id',jQuery(this).data('class'));
$.ajax({
        url: './actions/remove.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (data) {
          if (data.stat == 'error')
              alert(data.msg);
          else if (data.stat == 'success'){
             // location.reload();
}
        }
});
jQuery(this).parents('.profile-sidebar').fadeOut(1000);
});

jQuery('.remove-cat').click(function(){
    var formData = new FormData();
    formData.append('action','remove_cat');
    formData.append('id',jQuery(this).data('class'));
$.ajax({
        url: './actions/remove.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (data) {
          if (data.stat == 'error')
              alert(data.msg);
          else if (data.stat == 'success')
              location.reload();

        }
});

});
// remove product
jQuery('.remove-products').click(function(){
    var formData = new FormData();
    formData.append('action','remove_product');
    formData.append('id',jQuery(this).data('class'));
$.ajax({
        url: './actions/remove.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (data) {
          if (data.stat == 'error')
              alert(data.msg);
          else (data.stat == 'success')
              location.reload();

        }
});


});

// remove album imag
jQuery('.album_element').click(function(){
 // add id to hidden input 
 var new_value = jQuery('input[name=remove_albume_element]').val()+','+jQuery(this).data('class');
 jQuery('input[name=remove_albume_element]').val(new_value);
 // remove element from view
 jQuery(this).fadeOut();
 
 });
   </script>
  </body>
</html>