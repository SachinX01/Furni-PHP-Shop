<?php
include "template/head.php";

if (!isset($_SESSION['user']) || $_SESSION['user']->name_role !== "admin") {
    exit("Unauthorized access");
}

if (!isset($_GET['order_id'])) {
    exit("Order ID not provided");
}

$orderId = $_GET['order_id'];

// Get order items
$query = "SELECT oi.*, p.name_product, p.price_product, i.path_image 
          FROM orders_item oi 
          JOIN product p ON oi.id_product = p.id_product 
          JOIN prod_img pi ON p.id_product = pi.id_product 
          JOIN image i ON pi.id_image = i.id_image 
          WHERE oi.id_order = ?";

$ps = $conn->prepare($query);
$ps->execute([$orderId]);
$items = $ps->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name_product']); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars($item['path_image']); ?>" 
                         alt="<?php echo htmlspecialchars($item['name_product']); ?>" 
                         style="max-width: 50px;">
                </td>
                <td>₹<?php echo number_format($item['price_product'], 2); ?></td>
                <td><?php echo $item['quantity_o_item']; ?></td>
                <td>₹<?php echo number_format($item['subtotal_o_item'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
