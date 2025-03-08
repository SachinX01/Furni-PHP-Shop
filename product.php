<?php
include "template/head.php";
include "template/nav.php";

$id = $_GET['id'];
$sentProduct = getProduct($id);
$catID = $sentProduct[0]->id_cat;
$prodArr = getProductFromSameCategoryTop3($catID);
?>

<div class="product-section pb-0">
    <div class="container">

        <!-- Previous page -->
        <button id="backToProducts" class="btn mb-5"><i id="backArrow" class="fa-solid fa-chevron-left me-2"></i>Back</button>

        <!-- Product Info -->
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <img id="product-image" class="border border-10" src="<?= $sentProduct[0]->path_image ?>" alt="<?= $sentProduct[0]->name_image ?>" />
            </div>
            <div class="col-lg-6 col-sm-12 d-flex flex-column">
                <div id="product-details" class="p-3 border-10" data-prodid="<?= $sentProduct[0]->id_product ?>">
                    <h3><?= $sentProduct[0]->name_product ?></h3>
                    <p class="fw-bold">Category: <?= $sentProduct[0]->name_cat ?></p>
                    <p><?= $sentProduct[0]->desc_product ?></p>
                    <p class="fw-bold">Price: &#8377;<?= $sentProduct[0]->price_product ?></p>
                    <p class="fw-bold">Color: <?= $sentProduct[0]->name_color ?></p>
                    <p class="fw-bold">In Stock: <?= $sentProduct[0]->availability_product ?></p>
                </div>
                <?php if ($sentProduct[0]->availability_product > 0 && !empty($user)) : ?>
                    <button id="buyProduct" class="btn mt-5">Buy</button>
                <?php elseif (empty($user)) : ?>
                    <p class="alert alert-warning mt-3 text-uppercase">You need to <a href="login.php">login</a> in order to purchase.</p>
                    <button id="buyProduct" class="btn" disabled>Buy</button>
                <?php else : ?>
                    <p class="alert my-alert-danger mt-3 text-uppercase">not available at the moment!</p>
                    <button id="buyProduct" class="btn mt-5" disabled>Buy</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product already exist message toast -->
        <div class="toast-container position-fixed bottom-0 end-0 mb-3 start-50 translate-middle-x">
            <div id="productExistsToast" class="toast border-10" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body text-center p-0">Product already in a cart!</div>
            </div>
        </div>

    </div>
</div>

<!-- Start Product From Same Category Section -->
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

            <?php foreach ($prodArr as $prod) : ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="product-item" href="product.php?id=<?= $prod->id_product ?>">
                        <img src="<?= $prod->path_image ?>" alt="<?= $prod->name_image ?>" class="img-fluid product-thumbnail" />
                        <h3 class="product-title"><?= $prod->name_product ?></h3>
                        <strong class="product-price">&#8377;<?= $prod->price_product ?></strong>

                        <span class="icon-cross">
                            <img src="assets/images/cross.svg" class="img-fluid" />
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- End PrProduct From Same Categoryoduct Section -->

<?php
include "template/footer.php";
?>