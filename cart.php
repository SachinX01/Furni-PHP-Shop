<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "user") {
    $userID = $_SESSION['user']->id_user;
    $orderExist = getOrder($userID);
    $orderProducts = getAllOrders($userID);
?>
    <div class="container" id="cartPanel-div">
        <button id="backToProducts" class="btn mb-5 ms-sm-0 ms-2"><i id="backArrow" class="fa-solid fa-chevron-left me-2"></i>Back</button>
        <?php if (!$orderExist || empty($orderProducts)) : ?>

            <div id="empty-cart" class="m-auto"></div>

            <h1 class="text-center">YOUR CART IS EMPTY</h1>

        <?php else : ?>
            <h1 class="ms-sm-0 ms-2">YOUR CART</h1>

            <div class="d-flex gap-xl-4 gap-lg-4 flex-lg-row flex-sm-column flex-column px-2">
                <div id="cart-container" class="flex-grow-1">
                    <form>
                        <?php foreach ($orderProducts as $prod) : ?>
                            <div class="cart-item-container p-3 mb-3 border-10 d-flex w-100">
                                <div class="item-picture">
                                    <img height="100" class="border-10" src="<?= $prod->path_image ?>" alt="<?= $prod->name_image ?>" />
                                </div>
                                <div class="item-details flex-grow-1 px-4">
                                    <h6 class="mt-2 mb-4 text-black"><?= $prod->name_product ?></h6>
                                    <div class="input-group d-flex align-items-center quantity-container flex-sm-row flex-column ">
                                        <div class="d-flex align-items-center m-sm-0 me-auto">
                                            <button id="decreaseButton" class="decreaseButton me-3 rounded-pill d-flex justify-content-center align-items-center" type="button" data-product-id="<?= $prod->id_product; ?>" data-price="<?= $prod->price_product; ?>">&minus;</button>

                                            <input class="inputQuant px-2 form-control text-center quantity-amount border-10" type="text" value="<?= $prod->quantity_o_item ?>" data-max="<?= $prod->availability_product; ?>" data-product-id="<?= $prod->id_product; ?>" disabled />

                                            <button id="increaseButton" class="increaseButton ms-3 rounded-pill d-flex justify-content-center align-items-center" type="button" data-product-id="<?= $prod->id_product; ?>" data-price="<?= $prod->price_product; ?>">&plus;</button>
                                        </div>

                                        <p class="totalValue m-0 ms-3 text-black  me-auto">&#8377;<?= $prod->subtotal_o_item; ?></p>
                                    </div>
                                </div>
                                <div class="item-delete d-flex align-items-center">
                                    <button id="removeButton" data-prodid="<?= $prod->id_product ?>" type="button" class="btn redButton"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>

                <div id="shopping-cart-totals-info" class="h-100 d-flex flex-column p-3 border-10 ms-auto">

                    <div class="row">
                        <h2 class="mb-0">TOTAL</h2>
                    </div>

                    <hr class="mb-4" />

                    <div class="row mb-3">
                        <div class="col-6">
                            <span>Subtotal:</span>
                        </div>
                        <div class="col-6 text-end">
                            <strong id="subtotalValue" class="text-black">&#8377;0.00</strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <span>Shipping:</span>
                        </div>
                        <div class="col-6 text-end">
                            <strong id="shippingValue" class="text-black">&#8377;14.99</strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <strong class="text-black">Total:</strong>
                        </div>
                        <div class="col-6 text-end">
                            <strong id="totalValue" class="text-black">&#8377;0.00</strong>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div>
                            <button class="btn col-12" id="checkoutBtn">Checkout</button>
                        </div>
                    </div>

                </div>
            </div>

        <?php endif; ?>
    </div>
<?php
} else {
?>
    <div class="container" id="adminPanel-div">
        <div class="row justify-content-center align-items-center">
            <h1 class=" text-center">Please login first.</h1>
        </div>
    </div>
<?php
}
?>

<?php
include "template/footer.php";
?>