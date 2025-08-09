<?php require 'top.php';
require 'function.php';
$Product_id = mysqli_real_escape_string($conn, $_GET['id']);
$get_product = get_prod($conn, '', '', $Product_id);
//  prx($get_product);
// Fetch slider images for this product
$slider_sql = "SELECT * FROM product_slider WHERE product_id = '$Product_id'";
$slider_res = mysqli_query($conn, $slider_sql);

// $product_fetch_sql = "SELECT * FROM product WHERE id = '$Product_id'";
// $product_fetch_res = mysqli_query($conn, $product_fetch_sql);
// $product_fetch_row = mysqli_fetch_assoc($product_fetch_res);

$slider_images = [];
if ($slider_res && mysqli_num_rows($slider_res) > 0) {
    while ($row = mysqli_fetch_assoc($slider_res)) {
        $slider_images[] = $row['product_img'];
    }
}
// if($product_fetch_res && mysqli_num_rows($product_fetch_res) > 0){
//     $product_image = $product_fetch_row['image'];
//     $slider_images[] = $product_image;
// }

?>
<!-- <div class="ht__bradcaump__area" style="background: url('images/bg/4.jpg') no-repeat center center / cover; padding: 80px 0;">
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
</div> -->
<!-- Start Product Details Area -->
<section style="margin-top: 100px; margin-left:30px" class="htc__product__details bg__white ">
    <!-- <section class="htc__product__details bg__white"> -->
    <!-- Start Product Details Top -->
    <div class="max-w-7xl mx-auto px-2 py-10 w-[50%] ">
        <div class=" grid-cols-1 md:grid-cols-2 gap-10 flex justify-center ">


            <!-- Image Gallery -->
            <div class="flex">
                <!-- Thumbnails (Vertical Scroll) -->
                <div class="relative w-24 right-[70px] h-[500px] ">
                    <div id="thumbnail-container"
                        class="flex flex-col gap-3 overflow-y-auto h-96 scrollbar-hide">
                        <?php
                        $category = $get_product[0]['categories'];
                        $product_id = $get_product[0]['id'];
                        $index = 0;
                        foreach ($slider_images as $img) {
                            $active = ($index == 0) ? 'ring-2 ring-blue-500' : '';
                            echo "
            <div class='thumbnail cursor-pointer border $active' data-index='$index' tabindex='0'>
                <img src='" . PRODUCT_IMAGE_SITE_PATH . "/" . $category . "/" . $product_id . "/" . $img . "'
                     alt='product thumb' loading='lazy' />
            </div>";
                            $index++;
                        }
                        ?>
                    </div>
                    <!-- Up/Down Buttons -->
                    <div>

                        <button style='margin-left:-18px' id="thumb-up"
                            class=" top-[-25px] right-[20px] absolute top-0 left-1/2 -translate-x-1/2 bg-black/60 text-white shadow p-1 rounded-full z-10">
                            ▲
                        </button>
                        <button style='margin-left:-18px' id="thumb-down"
                            class="bottom-[85px] right-[20px] absolute bottom-0 left-1/2 -translate-x-1/2 bg-black/60 text-white shadow p-1 rounded-full z-10">
                            ▼
                        </button>
                    </div>


                </div>



                <!-- Big Image Slider -->
                <div class="relative flex-1 ml-5 sm:h-[500px]">
                    <div id="big-slider" class="relative overflow-hidden">
                        <div id="big-slider-track" class="flex transition-transform duration-500">
                            <?php
                            $index = 1;
                            foreach ($slider_images as $img) {
                                echo "
                            <div class='w-full flex-shrink-0'>
                                <img class='w-full h-[500px] object-contain rounded-lg border'
                                     src='" . PRODUCT_IMAGE_SITE_PATH . "/" . $category . "/" . $product_id . "/" . $img . "'
                                     alt='big-image'>
                            </div>";
                                $index++;
                            }
                            ?>
                        </div>
                    </div>


                    <!-- Slider Arrows -->
                    <button id="prev-slide"
                        class="left-[-60px] absolute top-1/2 left-3 transform -translate-y-1/2 bg-black/50 text-white p-4 rounded-full shadow hover:bg-black text-3xl">
                        <i class="fa-solid fa-less-than"></i>
                    </button>
                    <button id="next-slide"
                        class="right-[-60px] ml-[200px] absolute top-1/2 right-3 transform -translate-y-1/2 bg-black/50 text-white p-4 rounded-full shadow hover:bg-black text-3xl">
                        <i class="fa-solid fa-greater-than"></i>
                    </button>
                </div>
            </div>


            <!-- Product Details -->

        </div>
        <!-- NOW, Dscription BELOW the slider/grid -->
        <div class="mt-10">
            <div style="margin-left: 150px;">
                <h2 style="font-size: 40px; font-weight: 600; color:black; margin-top:120px; text-align: center;" class="text-2xl font-semibold mb-4">
                    <?php echo $get_product[0]['name'] ?>
                </h2>
                <ul class="flex gap-3 items-center mb-4 justify-center">
                    <!-- <label class="text-4xl text-blue-600 font-bold" for="price ">Price : </label> -->
                    <li class="text-gray-400 line-through text-4xl">₹<?php echo $get_product[0]['mrp'] ?></li>
                    <li class="text-4xl text-blue-600 font-bold">₹<?php echo $get_product[0]['price'] ?></li>
                </ul>

                <!-- category  -->
                <!-- <div class="flex">
                        <p style="font-size: 25px; position:relative; top:60px; color:black; font-weight: 400px;" class="font-medium  top-[20px]">Categories : </p>&nbsp; &nbsp;
                        <a style="font-size: 20px; position:relative; top:60px;  color:blue; font-weight: 400px;" class="text-blue-500 hover:underline"
                            href="categories.php?id=<?php echo $get_product[0]['categories_id'] ?>">
                            <?php echo $get_product[0]['categories'] ?>
                        </a>
                    </div> -->
            </div>
            <p style="font-size: 30px;line-height: 40px;color:black;font-weight: 400;width: 140%;margin-left: -135px;" class="text-gray-700 mb-6">
                <?php echo $get_product[0]['description'] ?>
            </p>

            <div class="flex ">
                <p style="font-size: 45px; position:relative; top:60px; color:black; font-weight: 900; margin-left: -135px;" class="font-medium  top-[20px]">Categories : </p>&nbsp; &nbsp;
                <a style="font-size: 35px; position:relative; top:60px;  color:blue; font-weight: 900;" class="text-blue-500 hover:underline"
                    href="categories.php?id=<?php echo $get_product[0]['categories_id'] ?>">
                    <?php echo $get_product[0]['categories'] ?>
                </a>
            </div>
        </div>
    </div>
    
    <!-- </section> -->
    </div>
    


</section>

<!-- JavaScript -->
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const bigSlider = document.getElementById('big-slider-track');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const totalSlides = thumbnails.length;
        let currentIndex = 0;

        const thumbContainer = document.getElementById('thumbnail-container');
        const btnUp = document.getElementById('thumb-up');
        const btnDown = document.getElementById('thumb-down');

        // Used for checking if scrolling buttons necessary
        function updateThumbScrollButtons() {
            // Check if container scrollable
            btnUp.style.display = thumbContainer.scrollTop > 0 ? 'block' : 'none';
            btnDown.style.display = (thumbContainer.scrollHeight - thumbContainer.clientHeight - thumbContainer.scrollTop > 2) ?
                'block' :
                'none';
        }

        function updateBigSlider(index) {
            bigSlider.style.transform = `translateX(-${index * 100}%)`;

            // Remove highlight from all thumbnails
            thumbnails.forEach(el => el.classList.remove('ring-2', 'ring-blue-500'));
            // Highlight the selected one
            thumbnails[index].classList.add('ring-2', 'ring-blue-500');

            // Scroll selected thumb into view
            thumbnails[index].scrollIntoView({
                block: 'nearest',
                behavior: 'smooth'
            });

            // Update up/down buttons
            setTimeout(updateThumbScrollButtons, 100);
        }

        thumbnails.forEach((thumb, idx) => {
            thumb.addEventListener('click', () => {
                currentIndex = idx;
                updateBigSlider(currentIndex);
            });
        });

        // Next/Prev Controls
        document.getElementById('next-slide').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateBigSlider(currentIndex);
        });

        document.getElementById('prev-slide').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateBigSlider(currentIndex);
        });

        // Thumbnail Scroll Buttons
        btnUp.addEventListener('click', () => {
            thumbContainer.scrollBy({
                top: -60,
                behavior: 'smooth'
            });
        });
        btnDown.addEventListener('click', () => {
            thumbContainer.scrollBy({
                top: 60,
                behavior: 'smooth'
            });
        });

        thumbContainer.addEventListener('scroll', updateThumbScrollButtons);

        // Initialize on Load
        updateBigSlider(currentIndex);
        updateThumbScrollButtons();
    });
    document.addEventListener('DOMContentLoaded', function() {
        const thumbContainer = document.getElementById('thumbnail-container');
        const btnUp = document.getElementById('thumb-up');
        const btnDown = document.getElementById('thumb-down');

        btnUp.addEventListener('click', () => {
            thumbContainer.scrollBy({
                top: -60,
                behavior: 'smooth'
            });
        });
        btnDown.addEventListener('click', () => {
            thumbContainer.scrollBy({
                top: 60,
                behavior: 'smooth'
            });
        });
    });
</script> -->

<?php include 'footer.php'; ?>