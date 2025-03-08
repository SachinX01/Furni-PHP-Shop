<?php
include "template/head.php";
include "template/nav.php";

$prodArr = getProductFromCategoryTop3();
?>

<!-- Start Hero Section -->
<div class="hero">
    <div class="container d-flex justify-content-center">
        <div class="intro-excerpt text-center">
            <h1>Our Services</h1>
            <p class="mb-0 fs-6">Explore our diverse services, ranging from innovative technology solutions to personalized assistance. We provide a comprehensive range of offerings tailored to meet your needs.</p>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section pb-0">
    <div class="container">
        <div class="row my-5">
            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="assets/images/truck.svg" alt="Image" class="imf-fluid">
                    </div>
                    <h3>Fast &amp; Free Shipping</h3>
                    <p>Experience swift and free shipping on all orders. Your convenience matters, and we ensure timely delivery to you.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="assets/images/bag.svg" alt="Image" class="imf-fluid">
                    </div>
                    <h3>Easy to Shop</h3>
                    <p>Explore easy shopping on our user-friendly website. Discover exciting options and make your purchase effortlessly with a few clicks.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <div class="feature">
                    <div class="icon">
                        <img src="assets/images/support.svg" alt="Image" class="imf-fluid">
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Need assistance? Our support team is available around the clock to answer your queries, provide guidance, and ensure a smooth shopping experience.</p>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-4">
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
</div>
<!-- End Why Choose Us Section -->

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