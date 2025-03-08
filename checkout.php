<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "user") {
    $userID = $_SESSION['user']->id_user;
    $orderExist = getOrder($userID);
    $orderProducts = getAllOrders($userID);

    $totalValue = 0;
    foreach($orderProducts as $prod){
        $totalValue += $prod->subtotal_o_item;
    }
    $totalValue += 14.99;
?>
    <!-- Start Checkout Section -->
    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <!-- BILLING DETAILS -->
                <div id="billing-details" class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white mb-5">
                        <p>You can change billing details here: <a href="profile.php">account page.</a></p>
                    </div>

                    <h2 class="h3 mb-3 text-black">Payment Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <p>Pay with cash upon arrival.</p>
                    </div>
                </div>

                <!-- ORDER DETAILS -->
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orderProducts as $prod) : ?>
                                            <tr>
                                                <td><?= $prod->name_product ?> <strong class="mx-2">x</strong> <?= $prod->quantity_o_item ?></td>
                                                <td>&#8377;<?= $prod->subtotal_o_item ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Shipping</strong></td>
                                            <td class="text-black">&#8377;14.99</td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td id="checkout-totalPrice" class="text-black font-weight-bold"><strong>&#8377;<?= $totalValue ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <button id="placeOrderBtn" data-order-id="<?= $orderProducts[0]->id_order ?>" class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
    <!-- End Checkout Section -->
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