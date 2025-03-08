<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "admin") {
    $id = $_GET['id'];
    $sentProduct = getProduct($id);

    $catArr = getAnyTable("category");
    $colorArr = getAnyTable("color");
?>

    <div class="product-section">
        <div id="adminProduct-div" class="container d-flex flex-column justify-content-center align-items-center">
            <div class="d-flex w-100">
                <button id="backToProducts" class="me-auto btn mb-5"><i id="backArrow" class="fa-solid fa-chevron-left me-2"></i>Back to panel</button>
                <button id="previewChangesBtn" class="ms-auto btn mb-5" data-product-id="<?= $id ?>">Preview changes<i id="backArrow" class="fa-solid fa-chevron-right ms-2"></i></button>
            </div>

            <h3 class="mb-3 alert alert-success w-100">Last updated: <?php echo $sentProduct[0]->modified_at_p; ?></h3>

            <form id="updateProductForm" class="w-100 border-10 p-3">
                <!-- PRODUCT IMAGE -->
                <div class="form-group col-12 mb-3">
                    <div id="image-product" class="w-100 d-flex justify-content-center border-10 bg-white">
                        <img class="" src="<?= $sentProduct[0]->path_image ?>" alt="<?= $sentProduct[0]->name_image ?>" />
                    </div>
                    <input type="file" name="imageProductUpdateBtn" id="imageProductUpdateBtn" class="my-3 form-control w-100" />
                    <span id="errorImageProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT NAME -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputNameProduct">Product Name</label>
                    <input type="text" class="form-control" id="inputNameProduct" name="inputNameProduct" placeholder="New product name" value="<?= $sentProduct[0]->name_product ?>">
                    <input type="hidden" id="inputCurrentNameProduct" name="inputCurrentNameProduct" value="<?= $sentProduct[0]->name_product ?>" />
                    <span id="errorNameProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT DESCRIPTION -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputDescriptionProduct">Description</label>
                    <textarea class="form-control" id="inputDescriptionProduct" cols="30" rows="5" placeholder="New product desc"><?= $sentProduct[0]->desc_product ?></textarea>
                    <span id="errorDescriptionProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT PRICE -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputPriceProduct">Price</label>
                    <input type="number" class="form-control" id="inputPriceProduct" name="inputPriceProduct" value="<?= $sentProduct[0]->price_product ?>">
                    <span id="errorPriceProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT AVAILABILITY -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputAvailabilityProduct">Availability</label>
                    <input type="number" class="form-control" id="inputAvailabilityProduct" name="inputAvailabilityProduct" value="<?= $sentProduct[0]->availability_product ?>">
                    <span id="errorAvailabilityProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT CATEGORY -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="selectCategoryProduct">Category</label>
                    <select name="selectCategoryProduct" id="selectCategoryProduct" class="form-control">
                        <option value="0">Choose</option>
                        <?php foreach ($catArr as $cat) : ?>
                            <?php $selected = ($cat->id_cat == $sentProduct[0]->id_cat) ? 'selected' : ''; ?>
                            <option value="<?= $cat->id_cat ?>" <?= $selected ?>><?= $cat->name_cat ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="errorCategoryProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT COLOR -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="selectColorProduct">Color</label>
                    <select name="selectColorProduct" id="selectColorProduct" class="form-control">
                        <option value="0">Choose</option>
                        <?php foreach ($colorArr as $color) : ?>
                            <?php $selected = ($color->id_color == $sentProduct[0]->id_color) ? 'selected' : ''; ?>
                            <option value="<?= $color->id_color ?>" <?= $selected ?>><?= $color->name_color ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="errorColorProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- UPDATE/DELETE BUTTON -->
                <div class="form-group col-12 d-flex flex-md-row flex-column justify-content-between">
                    <input type="btn" id="updateProduct" data-id="<?php echo $sentProduct[0]->id_product; ?>" name="updateProduct" class="btn mt-3" value="Update" />
                    <input type="btn" id="deleteProduct" data-id="<?php echo $sentProduct[0]->id_product; ?>" name="deleteProduct" class="btn mt-3 redButton" value="Delete" />
                </div>
            </form>

            <p id="response-text" class="w-100 mt-3 text-center fs-5 border-10"></p>
        </div>
    </div>

<?php
} else {
    header("Location: 404.php");
}
?>


<?php
include "template/footer.php";
?>