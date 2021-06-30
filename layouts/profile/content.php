<!-- stats  -->
<?php
$num_of_customers = get_number_customer();
$num_of_cats = count(get_categories());
$num_of_products = count(get_all('products'));
?>
<!-- stats  -->

<div class="row">
    <div class="col-lg-4 col-md-6" style="margin-top: 20px">
            <div class="card border-secondary">
                <a href="?view=view_customer">
                <div class="card-body bg-secondary text-white">
                    <div class="row">
                        <div class="col-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-9 text-right">
                            
                                <h1><?=$num_of_customers?></h1>
                                <h4>  Customers</h4>
                            
                        </div>
                    </div>
                </div>
                </a>
                <a href="?view=add_customer">
                    <div class="card-footer bg-light text-secondary">
                        <span class="float-left">Add New </span>
                        <span class="float-right"><i class="fa fa-plus"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    
<div class="col-lg-4 col-md-6" style="margin-top: 20px">
            <div class="card border-primary">
                <a href="?view=categories">
                <div class="card-body bg-primary text-white">
                    <div class="row">
                        <div class="col-3">
                            <i class="fa fa-tags fa-5x"></i>
                        </div>
                        <div class="col-9 text-right">
                            <h1><?=$num_of_cats?></h1>
                            <h4>  Categories</h4>
                        </div>
                    </div>
                </div>
                </a>
                <a href="?view=add_category">
                    <div class="card-footer bg-light">
                        <span class="float-left">Add New</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6" style="margin-top: 20px">
            <div class="card border-success">
                <a href="?view=products">
                <div class="card-body bg-success text-white">
                    <div class="row">
                        <div class="col-3">
                            <i class="fa fa-archive fa-5x"></i>
                        </div>
                        <div class="col-9 text-right">
                            <h1><?=$num_of_products?></h1>
                            <h4>  Product </h4>
                        </div>
                    </div>
                </div>
                </a>
                <a href="?view=add_product">
                    <div class="card-footer bg-light text-success">
                        <span class="float-left">Add new</span>
                        <span class="float-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
