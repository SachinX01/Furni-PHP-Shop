<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "admin") {
    $catArr = getAnyTable("category");
    $colorArr = getAnyTable("color");
    $imageArr = getAnyTable("image");
?>

    <div class="product-section">
        <div id="adminInsertProduct-div" class="container">
            <button id="backToProducts" class="btn mb-5"><i id="backArrow" class="fa-solid fa-chevron-left me-2"></i>Back to panel</button>

            <form id="insertProductForm" class="w-100 border-10 p-3">
                <!-- PRODUCT IMAGE -->
                <div class="form-group col-12 mb-3">
                    <div id="image-product" class="w-100 d-flex justify-content-center border-10 bg-white">
                        <img id="productImagePreview" class="" src="assets/images/Product Image.png" alt="Product Image.png" />
                    </div>
                    <input type="file" name="imageProductUpdateBtn" id="imageProductUpdateBtn" class="my-3 form-control w-100" />
                    <span id="errorImageProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT NAME -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputNameProduct">Product Name</label>
                    <input type="text" class="form-control" id="inputNameProduct" name="inputNameProduct" placeholder="New product name">
                    <span id="errorNameProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT DESCRIPTION -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputDescriptionProduct">Description</label>
                    <textarea class="form-control" id="inputDescriptionProduct" cols="30" rows="5" placeholder="New product desc"></textarea>
                    <span id="errorDescriptionProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT PRICE -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputPriceProduct">Price</label>
                    <input type="number" class="form-control" id="inputPriceProduct" name="inputPriceProduct" value="0">
                    <span id="errorPriceProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT AVAILABILITY -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="inputAvailabilityProduct">Availability</label>
                    <input type="number" class="form-control" id="inputAvailabilityProduct" name="inputAvailabilityProduct" value="0">
                    <span id="errorAvailabilityProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- PRODUCT CATEGORY -->
                <div class="form-group col-12 mb-3">
                    <label class="text-black" for="selectCategoryProduct">Category</label>
                    <select name="selectCategoryProduct" id="selectCategoryProduct" class="form-control">
                        <option value="0">Choose</option>
                        <?php foreach ($catArr as $cat) : ?>
                            <option value="<?= $cat->id_cat ?>"><?= $cat->name_cat ?></option>
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
                            <option value="<?= $color->id_color ?>"><?= $color->name_color ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="errorColorProduct" class="mb-0 text-danger"></span>
                </div>
                <!-- INSERT PRODUCT BUTTON -->
                <input type="btn" id="insertNewProduct" name="insertNewProduct" class="btn mt-3" value="Add new product" />
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