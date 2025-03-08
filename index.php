<?php
include "template/head.php";
include "template/nav.php";

$prodArr = getProductFromCategoryTop3();
?>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
                    <p class="mb-4">Welcome to Furni &ndash; Your Gateway to Timeless Elegance. Discover a world where sophistication meets comfort, and where each piece of furniture tells a unique story.</p>
                    <p><a href="shop.php" class="btn btn-secondary me-2">Shop Now</a></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="assets/images/couch.png" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Product Section -->
<div class="product-section">
    <div class="container">
        <div class="row">

            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                <p class="mb-4">Discover our most popular products and transform your space with the latest trends and timeless classics for a stylish home.</p>
                <p><a href="shop.php" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->

            <?php foreach ($prodArr as $pod) : ?>
                <?php if ($pod->name_cat == "Armchair") : ?>
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="product.php?id=<?= $pod->id_product ?>">
                            <img src="<?= $pod->path_image ?>" alt="<?= $pod->name_image ?>" class="img-fluid product-thumbnail" />
                            <h3 class="product-title"><?= $pod->name_product ?></h3>
                            <strong class="product-price">&#8377;<?= $pod->price_product ?></strong>

                            <span class="icon-cross">
                                <img src="assets/images/cross.svg" class="img-fluid" />
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- End Product Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Why Choose Us</h2>
                <p>Discover unparalleled quality, unique designs, and seamless satisfaction with us. Your best decision for a top-notch shopping experience.</p>

                <div class="row my-5">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="assets/images/truck.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Fast &amp; Free Shipping</h3>
                            <p>Experience swift and free shipping on all orders. Your convenience matters, and we ensure timely delivery to you.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="assets/images/bag.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Easy to Shop</h3>
                            <p>Explore easy shopping on our user-friendly website. Discover exciting options and make your purchase effortlessly with a few clicks.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="assets/images/support.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>24/7 Support</h3>
                            <p>Need assistance? Our support team is available around the clock to answer your queries, provide guidance, and ensure a smooth shopping experience.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="assets/images/return.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Hassle Free Returns</h3>
                            <p>Not satisfied with your purchase? No worries. Our hassle-free returns policy allows you to return items easily, ensuring your peace of mind.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="assets/images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Why Choose Us Section -->

<!-- Start We Help Section -->
<div class="we-help-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="imgs-grid">
                    <div class="grid grid-1"><img src="assets/images/img-grid-1.jpg" alt="Untree.co"></div>
                    <div class="grid grid-2"><img src="assets/images/img-grid-2.jpg" alt="Untree.co"></div>
                    <div class="grid grid-3"><img src="assets/images/img-grid-3.jpg" alt="Untree.co"></div>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5">
                <h2 class="section-title mb-4">We Help You Make Modern Interior Design</h2>
                <p>Transform your space with our expertise in modern interior design. Our dedicated team is committed to enhancing your living environment, combining functionality with contemporary aesthetics.</p>

                <ul class="list-unstyled custom-list my-4 d-flex flex-column ">
                    <li class="w-100"><b>Expert Designers:</b> Our experienced designers bring innovative and modern concepts to life, ensuring a stylish and functional interior.</li>
                    <li class="w-100"><b>Solutions:</b> Tailoring designs to suit your preferences, we create spaces that resonate with your lifestyle and taste.</li>
                    <li class="w-100"><b>Quality Materials:</b> We prioritize quality, using premium materials to deliver durable and sophisticated interior solutions.</li>
                    <li class="w-100"><b>Timely Execution:</b> We understand the value of time. Our efficient team ensures timely execution without compromising on excellence.</li>
                </ul>
                <a href="services.php" class="btn" >Explore</a>
            </div>
        </div>
    </div>
</div>
<!-- End We Help Section -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Testimonials</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Incredible selection and quality! Furni helped me find the perfect pieces to elevate my home's interior. Couldn't be happier with the service and style.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="assets/images/person_4.jpg" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Maria Jones</h3>
                                            <span class="position d-block mb-3">Bought chair: Symphony Seating</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Fast and efficient! From browsing to delivery, Furni made the entire process seamless. Their attention to detail and customer satisfaction is truly commendable.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="assets/images/person_3.jpg" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Ethan Rodriguez</h3>
                                            <span class="position d-block mb-3">Bought table: Coastal Breeze</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Amazing customer support! I had a few questions about my order, and the team at Furni provided quick and helpful assistance. Great experience all around!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
                                                <img src="assets/images/person_1.jpg" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Mark Bennett</h3>
                                            <span class="position d-block mb-3">Bought couch: Luxe Lounge</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END item -->

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->

<?php
include "template/footer.php";
?>