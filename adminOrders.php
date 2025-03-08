<?php
include "template/head.php";
include "template/nav.php";

if (isset($_SESSION['user']) && $_SESSION['user']->name_role == "admin") {
    // Handle order status updates
    if(isset($_POST['order_id']) && isset($_POST['action'])) {
        $orderId = $_POST['order_id'];
        $action = $_POST['action'];
        
        global $conn;
        $query = "UPDATE orders SET status_order = ?, modified_at_customer = CURRENT_TIMESTAMP WHERE id_order = ?";
        $ps = $conn->prepare($query);
        $ps->execute([$action, $orderId]);
    }

    // Get all orders
    $query = "SELECT o.*, u.fn_user, u.ln_user, u.email_user, u.phone_user 
              FROM orders o 
              JOIN user u ON o.id_user = u.id_user 
              ORDER BY o.created_at_customer DESC";
    $orders = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container untree_co-section product-section before-footer-section">
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2 class="section-title">Order Management</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Contact</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?php echo $order['id_order']; ?></td>
                                <td><?php echo $order['fn_user'] . ' ' . $order['ln_user']; ?></td>
                                <td>
                                    Email: <?php echo $order['email_user']; ?><br>
                                    Phone: <?php echo $order['phone_user']; ?>
                                </td>
                                <td>₹<?php echo number_format($order['total_price_customer'], 2); ?></td>
                                <td><?php echo date('M d, Y H:i', strtotime($order['created_at_customer'])); ?></td>
                                <td><?php echo $order['modified_at_customer'] != '0000-00-00 00:00:00' ? date('M d, Y H:i', strtotime($order['modified_at_customer'])) : 'Not updated'; ?></td>
                                <td>
                                    <span class="badge <?php 
                                        echo match($order['status_order']) {
                                            'pending' => 'bg-warning',
                                            'approved' => 'bg-info',
                                            'processing' => 'bg-primary',
                                            'completed' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    ?>">
                                        <?php echo ucfirst($order['status_order']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    // Show appropriate action buttons based on current status
                                    switch($order['status_order']) {
                                        case 'pending':
                                            ?>
                                            <form method="post" class="d-inline">
                                                <input type="hidden" name="order_id" value="<?php echo $order['id_order']; ?>">
                                                <button type="submit" name="action" value="approved" class="btn btn-sm" style="background-color: #28a745; color: white;">
                                                    Approve
                                                </button>
                                                <button type="submit" name="action" value="rejected" class="btn btn-sm" style="background-color: #dc3545; color: white;">
                                                    Reject
                                                </button>
                                            </form>
                                            <?php
                                            break;
                                        case 'approved':
                                            ?>
                                            <form method="post" class="d-inline">
                                                <input type="hidden" name="order_id" value="<?php echo $order['id_order']; ?>">
                                                <button type="submit" name="action" value="processing" class="btn btn-sm" style="background-color: #007bff; color: white;">
                                                    Start Processing
                                                </button>
                                            </form>
                                            <?php
                                            break;
                                        case 'processing':
                                            ?>
                                            <form method="post" class="d-inline">
                                                <input type="hidden" name="order_id" value="<?php echo $order['id_order']; ?>">
                                                <button type="submit" name="action" value="completed" class="btn btn-sm" style="background-color: #28a745; color: white;">
                                                    Approve
                                                </button>
                                                <button type="submit" name="action" value="rejected" class="btn btn-sm" style="background-color: #dc3545; color: white;">
                                                    Reject
                                                </button>
                                            </form>
                                            <?php
                                            break;
                                    }
                                    ?>
                                    <button type="button" class="btn btn-sm btn-secondary view-details" 
                                            data-order-id="<?php echo $order['id_order']; ?>">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle View Details button clicks
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.dataset.orderId;
                
                // Fetch order details
                fetch(`get_order_details.php?order_id=${orderId}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('#orderDetailsModal .modal-body').innerHTML = html;
                        new bootstrap.Modal(document.getElementById('orderDetailsModal')).show();
                    });
            });
        });
    });
    </script>

<?php
} else {
    header("Location: 404.php");
}

include "template/footer.php";
?>
