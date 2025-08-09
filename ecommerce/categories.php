<?php require 'top.php';
require 'function.php';
$cat_id = mysqli_real_escape_string($conn, $_GET['id']);
 $get_product = get_prod($conn, '', $cat_id);
?>
<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
    <!-- Start Search Popap -->
    <div class="search__area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search__inner">
                        <form action="#" method="get">
                            <input placeholder="Search here... " type="text">
                            <button type="submit"></button>
                        </form>
                        <div class="search__close__btn">
                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Popap -->
    <!-- Start Cart Panel -->
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$105.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.html">Brone Candle</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$25.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
            </div>
            <ul class="shoping__total">
                <li class="subtotal">Subtotal:</li>
                <li class="total__price">$130.00</li>
            </ul>
            <ul class="shopping__btn">
                <li><a href="cart.html">View Cart</a></li>
                <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
            </ul>
        </div>
    </div>
    <!-- End Cart Panel -->
</div>
<!-- End Offset Wrapper -->
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: url('images/bg/4.jpg') no-repeat center center / cover; padding: 80px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="bradcaump__inner">
                    <nav class="bradcaump-inner" aria-label="breadcrumb" style="font-size: 20px; font-weight: 600; color: #ffffff; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                        <a class="breadcrumb-item" href="index.php" style="     display: inline-table; color:#ffffff; text-decoration:none;">Home</a>
                        <span class="brd-separetor" style="color:#ffffff; margin: 0 10px;">
                            <i class="zmdi zmdi-chevron-right"></i>
                        </span>
                        <a href="categories.php?id" class="breadcrumb-item active" style=" display: inline-table; color:#ffffff;">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <?php if(count( $get_product)>0){?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    <div class="htc__grid__top">
                        <div class="htc__select__option">
                            <select class="ht__select">
                                <option>Default softing</option>
                                <option>Sort by popularity</option>
                                <option>Sort by average rating</option>
                                <option>Sort by newness</option>
                            </select>
                        </div>
                        <div class="ht__pro__qun">
                            <span>Showing 1-12 of 1033 products</span>
                        </div>
                        <!-- Start List And Grid View -->
                        <ul class="view__mode" role="tablist">
                            <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-grid"></i></a></li>
                            <li role="presentation" class="list-view"><a href="#list-view" role="tab" data-toggle="tab"><i class="zmdi zmdi-view-list"></i></a></li>
                        </ul>
                        <!-- End List And Grid View -->
                    </div>
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <!-- Start Single Product -->
                                <?php
                                $cat_id = $_GET['id'];
                                // $get_product = get_prod($conn, '', $cat_id);
                                // prx($get_product);
                                foreach ($get_product as $products) {

                                ?>
                                    <!-- Start Single Category -->
                                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                        <div class="category">
                                            <div class="ht__cat__thumb">
                                                <a href="product.php?id=<?php echo $products['id']; ?>">

                                                    <?php $img = PRODUCT_IMAGE_SITE_PATH . $products["image"]; ?>
                                                    <img src="<?php echo $img; ?>" alt="product images">
                                                </a>
                                            </div>
                                            <div class="fr__hover__info">
                                                <ul class="product__action">
                                                    <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>

                                                    <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>

                                                    <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="fr__product__inner">
                                                <h4><a href="product-details.html"><?php echo $products['name']; ?> </a></h4>
                                                <ul class="fr__pro__prize">
                                                    <li class="old__prize">₹<?php echo $products['mrp'] ?></li>
                                                    <li>₹<?php echo $products['price'] ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Category -->
                                <?php } ?>
                                <!-- End Single Product -->
                            </div>

                            <!-- TODO: start with row  -->
                            <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">
                                <?php
                                $get_product = get_prod($conn, '', $cat_id);
                                // prx($get_product);
                                foreach ($get_product as $products) {

                                ?>
                                    <div class="col-xs-12">
                                        <div class="ht__list__wrap">
                                            <div class="ht__list__product">
                                                <div class="ht__list__thumb">
                                                    <?php $img = PRODUCT_IMAGE_SITE_PATH . $products["image"]; ?>
                                                    <a href="product-details.html"><img class="h-[200px] w-[300px]" src="<?php echo $img; ?>" alt="product images"></a>

                                                </div>
                                                <div class="htc__list__details">
                                                    <h2><a href="product-details.html"><?php echo $products['name']; ?> </a></h2>
                                                    <ul class="pro__prize">
                                                        <li class="old__prize">$<?php echo $products['mrp']; ?></li>
                                                        <li>₹<?php echo $products['price']; ?></li>
                                                    </ul>
                                                    <!-- <ul class="rating">
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li><i class="icon-star icons"></i></li>
                                                    <li class="old"><i class="icon-star icons"></i></li>
                                                    <li class="old"><i class="icon-star icons"></i></li>
                                                </ul> -->
                                                    <p><?php echo $products['short_desc']; ?>.</p>
                                                    <div class="fr__list__btn">
                                                        <a class="fr__btn" href="cart.html">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- TODO: END ROW  -->
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
                <!-- Start Pagenation -->
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="htc__pagenation">
                            <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">3</a></li>
                            <li><a href="#">19</a></li>
                            <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Pagenation -->
            </div>
            <?php } else{
            echo '<h1 class="text-center text-9xl lg:text-[160px]">No Product Found</h1>';


            }?>

        </div>
    </div>
</section>
<!-- End Product Grid -->
<!-- Start Brand Area -->
<div class="htc__brand__area bg__cat--4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ht__brand__inner">
                    <ul class="brand__list owl-carousel clearfix">
                        <li><a href="#"><img src="images/brand/1.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/2.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/3.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/4.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/5.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/5.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/1.png" alt="brand images"></a></li>
                        <li><a href="#"><img src="images/brand/2.png" alt="brand images"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Brand Area -->
<!-- Start Banner Area -->
<div class="htc__banner__area">
    <ul class="banner__list owl-carousel owl-theme clearfix">
        <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/3.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/4.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/5.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/6.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/1.jpg" alt="banner images"></a></li>
        <li><a href="product-details.html"><img src="images/banner/bn-3/2.jpg" alt="banner images"></a></li>
    </ul>
</div>
<!-- End Banner Area -->
<!-- End Banner Area -->
<?php require 'footer.php'; ?>