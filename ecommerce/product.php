<?php require 'top.php';
require 'function.php';
$Product_id = mysqli_real_escape_string($conn, $_GET['id']);
$get_product = get_prod($conn, '', '', $Product_id);
//  prx($get_product);
// Fetch slider images for this product
$slider_sql = "SELECT * FROM product_slider WHERE product_id = '$Product_id'";
$slider_res = mysqli_query($conn, $slider_sql);
// Fetch main product image
$product_fetch_sql = "SELECT * FROM product WHERE id = '$Product_id'";
$product_fetch_res = mysqli_query($conn, $product_fetch_sql);
$product_fetch_row = mysqli_fetch_assoc($product_fetch_res);

// Collect slider images (from product_slider)
$slider_images = [];
if ($slider_res && mysqli_num_rows($slider_res) > 0) {
    while ($row = mysqli_fetch_assoc($slider_res)) {
        $slider_images[] = $row['product_img'];
    }
}

// Combine main image and slider images.
$slider_images_all = [];

// Add main product image first from 'image' column
if (!empty($product_fetch_row['image'])) {
    $slider_images_all[] = $product_fetch_row['image'];
}

// Add all additional images from 'product_img' column
foreach ($slider_images as $img) {
    $slider_images_all[] = $img;
}

// $product_fetch_sql = "SELECT * FROM product WHERE id = '$Product_id'";
// $product_fetch_res = mysqli_query($conn, $product_fetch_sql);
// $product_fetch_row = mysqli_fetch_assoc($product_fetch_res);

// $slider_images = [];
// if ($slider_res && mysqli_num_rows($slider_res) > 0) {
//     while ($row = mysqli_fetch_assoc($slider_res)) {
//         $slider_images[] = $row['product_img'];
//     }
// }
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
 <section style="margin-top: 150px;" class="htc__product__details bg-white mt-24 max-w-[1200px] mx-auto px-6">
  <style>
    /* Hide the small thumbnail slider by default */
    #thumbnail-wrapper {
      display: none;
    }

    /* Show thumbnails on desktop and laptop */
    @media screen and (min-width: 1024px) {
      #thumbnail-wrapper {
        display: flex;
        position: relative;
        width: 6rem; /* 96px */
        right: 70px;
        height: 500px;
        flex-direction: column;
        gap: 0.75rem;
      }

      /* Hide dots on desktop/laptop */
      #slider-dots {
        display: none;
      }
    }

    /* Dots visible on small & medium devices */
    #slider-dots {
      text-align: center;
      margin-top: 12px;
      display: block;
    }

    /* Thumbnail container */
    #thumbnail-container {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      overflow-y: auto;
      height: 96%;
      scrollbar-width: thin;
    }
    #thumbnail-container::-webkit-scrollbar {
      display: none;
    }

    /* Thumbnail styles */
    .thumbnail {
      border: 2px solid transparent;
      border-radius: 0.5rem;
      cursor: pointer;
      transition: border-color 0.25s ease;
      padding: 2px;
      background: #f9fafb;
      box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
    }
    .thumbnail:hover,
    .thumbnail:focus {
      border-color: #2563eb;
      outline: none;
    }
    .thumbnail.ring-2.ring-blue-500 {
      border-color: #2563eb;
      box-shadow: 0 0 6px #60a5fa;
      background: #e0f2fe;
    }
    .thumbnail img {
      width: 100%;
      height: 80px;
      object-fit: cover;
      border-radius: 0.5rem;
      display: block;
    }

    /* Scroll buttons for thumbnails */
    #thumb-up, #thumb-down {
      margin-left: -18px;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
      border-radius: 50%;
      padding: 0.35rem 0.5rem;
      border: none;
      font-weight: bold;
      cursor: pointer;
      z-index: 10;
      transition: background-color 0.3s ease;
      user-select: none;
    }
    #thumb-up:hover, #thumb-down:hover,
    #thumb-up:focus, #thumb-down:focus {
      background: #2563eb;
      outline: none;
    }
    /* #thumb-up {
      top: 0.5rem;
    }
    #thumb-down {
      bottom: 3.5rem;
    } */

    /* Big slider styling */
    #big-slider {
      overflow: hidden;
      border-radius: 0.75rem;
      box-shadow: 0 5px 15px rgb(0 0 0 / 0.1);
    }
    #big-slider-track {
      display: flex;
      transition: transform 0.5s ease;
      will-change: transform;
    }
    #big-slider-track > div {
      flex-shrink: 0;
      width: 100%;
      user-select: none;
    }
    #big-slider-track img {
      width: 100%;
      max-height: 500px;
      object-fit: contain;
      border-radius: 0.75rem;
      display: block;
      background: #fff;
    }

    /* Slider arrows */
    #prev-slide, #next-slide {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      border: none;
      padding: 0.75rem 1rem;
      border-radius: 50%;
      font-size: 1.8rem;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
      z-index: 20;
      transition: background-color 0.3s ease;
      user-select: none;
    }
    #prev-slide:hover, #next-slide:hover,
    #prev-slide:focus, #next-slide:focus {
      background-color: #2563eb;
      outline: none;
    }
    #prev-slide {
      left: 1rem;
    }
    #next-slide {
      right: 1rem;
    }

    /* Layout container for image gallery */
    .image-gallery {
      display: flex;
      gap: 2rem;
      justify-content: center;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    /* Product details styling */
    .product-details {
      max-width: 900px;
      margin: 2rem auto 0;
      text-align: center;
      padding: 0 1rem;
    }
    .product-details h2 {
      font-size: 2.75rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 0.5rem;
      line-height: 1.1;
    }
    .price-container {
      display: flex;
      justify-content: center;
      gap: 1rem;
      align-items: baseline;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }
    .price-container .price-mrp {
      color: #6b7280;
      font-size: 1.75rem;
      text-decoration: line-through;
    }
    .price-container .price-current {
      font-size: 2.25rem;
      color: #2563eb;
      font-weight: 900;
    }
    .product-desc {
      font-size: 1.25rem;
      color: #374151;
      line-height: 1.6;
      max-width: 900px;
      margin: 0 auto 3rem;
    }
    .product-category {
      font-size: 1.75rem;
      font-weight: 900;
      color: #111827;
      margin-bottom: 0.5rem;
    }
    .product-category a {
      color: #2563eb;
      font-weight: 900;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .product-category a:hover,
    .product-category a:focus {
      text-decoration: underline;
      outline: none;
      color: #1e40af;
    }

    /* Responsive fixes */
    @media (max-width: 768px) {
      #big-slider-track img {
        max-height: 300px;
      }
      .product-details h2 {
        font-size: 2rem;
      }
      .price-container .price-current {
        font-size: 1.75rem;
      }
      .product-desc {
        font-size: 1rem;
        max-width: 100%;
      }
      .product-category {
        font-size: 1.25rem;
      }
      #thumbnail-wrapper {
        display: none !important;
      }
    }
  </style>


  <div class="image-gallery" style=" position: relative; right: 60px;">

    <!-- Thumbnails -->
    <div style="height: 445px;" id="thumbnail-wrapper" role="list" aria-label="Product thumbnails">
      <div id="thumbnail-container" tabindex="0">
        <?php
        $category = $get_product[0]['categories'];
$product_id = $get_product[0]['id'];
$index = 0;

foreach ($slider_images_all as $img) {
    $active = ($index == 0) ? 'ring-2 ring-blue-500' : '';

    if ($index === 0) {
        // For main product image (first image), use path without category/product_id folders, adjust if necessary
        $img_src = PRODUCT_IMAGE_SITE_PATH . $img;
    } else {
        // For other slider images, use category and product ID folders
        $img_src = PRODUCT_IMAGE_SITE_PATH . "/" . $category . "/" . $product_id . "/" . $img;
    }

    echo "
    <div class='thumbnail cursor-pointer border $active' data-index='$index' tabindex='0'>
        <img src='$img_src' alt='image $index' loading='lazy'>
    </div>";

    $index++;
}

          // $category = $get_product[0]['categories'];
          // $product_id = $get_product[0]['id'];
          // $index = 0;
          // foreach ($slider_images as $img) {
          //   $active = ($index == 0) ? 'ring-2 ring-blue-500' : '';
          //   echo "
          //   <div class='thumbnail cursor-pointer border $active' data-index='$index' tabindex='0' role='button' aria-label='Select image ".($index+1)."'>
          //     <img src='" . PRODUCT_IMAGE_SITE_PATH . "/" . $category . "/" . $product_id . "/" . $img . "'
          //       alt='product thumbnail ".($index+1)."' loading='lazy' />
          //   </div>";
          //   $index++;
          // }
        ?>
      </div>

        <!-- Up/Down Buttons -->
                    <div>

                        <button style='margin-left: 5px;display: block;border-radius: 0;margin-right: -25px;' id="thumb-up"
                            class=" top-[-25px] right-[20px] absolute top-0 left-1/2 -translate-x-1/2 bg-black/60 text-white shadow p-1 rounded-full z-10">
                            ▲
                        </button>
                        <button style='margin-left: 5px;display: block;border-radius: 0;margin-right: -25px;' id="thumb-down"
                            class="bottom-[0px] right-[20px] absolute bottom-0 left-1/2 -translate-x-1/2 bg-black/60 text-white shadow p-1 rounded-full z-10">
                            ▼
                        </button>
                    </div>
    </div>

    <!-- Big Image Slider -->
    <div class="relative flex-1 min-w-[300px] max-w-[700px]">

      <div id="big-slider" aria-live="polite" aria-atomic="true">
        <div id="big-slider-track">
          <?php
           
$index = 0;
foreach ($slider_images_all as $img) {
    if ($index == 0) {
        $img_src = PRODUCT_IMAGE_SITE_PATH . $img;
    } else {
        $img_src = PRODUCT_IMAGE_SITE_PATH . "/" . $category . "/" . $product_id . "/" . $img;
    }
    echo "
    <div class='w-full flex-shrink-0'>
        <img class='w-full object-contain rounded-lg border'
            src='$img_src' alt='big-image'>
    </div>";
    $index++;
}
 

            // $index = 1;
            // foreach ($slider_images as $img) {
            //   echo "
            //   <div class='w-full flex-shrink-0'>
            //     <img class='w-full object-contain rounded-lg border'
            //       src='" . PRODUCT_IMAGE_SITE_PATH . "/" . $category . "/" . $product_id . "/" . $img . "'
            //       alt='big-image'>
            //   </div>";
            //   $index++;
            // }
          ?>
        </div>
      </div>

      <!-- Image Dots -->
      <div id="slider-dots"></div>

      <!-- Slider Arrows -->
      <button id="prev-slide" aria-label="Previous slide" title="Previous slide">&#10094;</button>
      <button id="next-slide" aria-label="Next slide" title="Next slide">&#10095;</button>
    </div>
  </div>

  <!-- Product Details -->
  <div class="product-details" aria-label="Product details">
    <h2 style="margin-top: 20px;"><?php echo $get_product[0]['name'] ?></h2>
    <div class="price-container">
      <span style="margin-top: 30px;" class="price-mrp">₹<?php echo $get_product[0]['mrp'] ?></span>
      <span style="margin-top: 30px;" class="price-current">₹<?php echo $get_product[0]['price'] ?></span>
    </div>
    <p class="product-desc"><?php echo $get_product[0]['description'] ?></p>
    <div class="product-category">
      Categories:
      <a href="categories.php?id=<?php echo $get_product[0]['categories_id'] ?>">
        <?php echo $get_product[0]['categories'] ?>
      </a>
    </div>
    <button><a href="https://api.whatsapp.com/send/?phone=919974381544&text=Hi" class="buy-btn">Buy Now</a></button>
  </div>

</section>
<style>
  .buy-btn {
    width: 100% ;
    display: inline-block;
    background-color: #0a58ca;  /* Blue */
    color: white;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border-radius: 6px;
    transition: background-color 0.3s ease;
        width: 900px;
    margin-top: 30px;
}

.buy-btn:hover {
    background-color: #084298; /* Darker Blue on Hover */
    color: white;
}

/* Responsive: Make it full-width on small screens */
@media (max-width: 600px) {
    .buy-btn {
        display: block;
        width: 100%;
        text-align: center;
        font-size: 18px;
        padding: 14px;
    }
}
</style>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bigSlider = document.getElementById('big-slider-track');
    const thumbnails = document.querySelectorAll('.thumbnail');
    const totalSlides = thumbnails.length;
    let currentIndex = 0;

    const thumbContainer = document.getElementById('thumbnail-container');
    const btnUp = document.getElementById('thumb-up');
    const btnDown = document.getElementById('thumb-down');

    const dotsContainer = document.getElementById('slider-dots');

    function updateThumbScrollButtons() {
      if (!thumbContainer) return;
      btnUp.style.display = thumbContainer.scrollTop > 0 ? 'block' : 'none';
      btnDown.style.display = (thumbContainer.scrollHeight - thumbContainer.clientHeight - thumbContainer.scrollTop > 2) ? 'block' : 'none';
    }

    function updateBigSlider(index) {
      bigSlider.style.transform = `translateX(-${index * 100}%)`;

      thumbnails.forEach(el => el.classList.remove('ring-2', 'ring-blue-500'));
      if (thumbnails[index]) {
        thumbnails[index].classList.add('ring-2', 'ring-blue-500');
        thumbnails[index].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
      }

      updateDots(index);
      setTimeout(updateThumbScrollButtons, 100);
    }

    function createDots() {
      if (!dotsContainer) return;
      dotsContainer.innerHTML = '';
      for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('span');
        dot.classList.add('slider-dot');
        dot.style.cursor = 'pointer';
        dot.style.height = '12px';
        dot.style.width = '12px';
        dot.style.margin = '0 6px';
        dot.style.backgroundColor = i === 0 ? '#3b82f6' : '#bbb'; // active blue, inactive grey
        dot.style.borderRadius = '50%';
        dot.style.display = 'inline-block';

        dot.setAttribute('data-index', i);

        dot.addEventListener('click', () => {
          currentIndex = i;
          updateBigSlider(currentIndex);
        });

        dotsContainer.appendChild(dot);
      }
    }

    function updateDots(index) {
      if (!dotsContainer) return;
      const dots = dotsContainer.querySelectorAll('.slider-dot');
      dots.forEach((dot, i) => {
        dot.style.backgroundColor = (i === index) ? '#3b82f6' : '#bbb';
      });
    }

    thumbnails.forEach((thumb, idx) => {
      thumb.addEventListener('click', () => {
        currentIndex = idx;
        updateBigSlider(currentIndex);
      });
    });

    document.getElementById('next-slide').addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % totalSlides;
      updateBigSlider(currentIndex);
    });

    document.getElementById('prev-slide').addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
      updateBigSlider(currentIndex);
    });

    if (btnUp && thumbContainer) {
      btnUp.addEventListener('click', () => {
        thumbContainer.scrollBy({ top: -60, behavior: 'smooth' });
      });
    }
    if (btnDown && thumbContainer) {
      btnDown.addEventListener('click', () => {
        thumbContainer.scrollBy({ top: 60, behavior: 'smooth' });
      });
    }

    if (thumbContainer) {
      thumbContainer.addEventListener('scroll', updateThumbScrollButtons);
    }

    createDots();
    updateBigSlider(currentIndex);
    updateThumbScrollButtons();
  });
</script>

<?php include 'footer.php'; ?>