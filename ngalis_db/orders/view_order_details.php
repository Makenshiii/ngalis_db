<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Order Details</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$order = $conn->query("SELECT o.*, CONCAT(c.name) AS customer FROM orders o LEFT JOIN customers c ON c.customer_id=o.customer_id WHERE o.order_id=$id");
if ($order->num_rows == 0) { echo '<p>Order not found. <a href="view_orders.php">Back</a></p>'; exit; }
$o = $order->fetch_assoc();
?>
<h2>Order #<?php echo $o['order_id']; ?></h2>
<p><strong>Customer:</strong> <?php echo htmlspecialchars($o['customer']); ?><br>
<strong>Order Date:</strong> <?php echo $o['order_date']; ?><br>
<strong>Total:</strong> <?php echo number_format($o['total_amount'],2); ?></p>

<h3>Items</h3>
<table><tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th></tr>
<?php
$items = $conn->query("SELECT oi.*, p.product_name FROM order_items oi LEFT JOIN products p ON p.product_id=oi.product_id WHERE oi.order_id=$id");
while ($it = $items->fetch_assoc()) {
    $sub = $it['quantity'] * $it['unit_price'];
    echo '<tr>';
    echo '<td>'.htmlspecialchars($it['product_name']).'</td>';
    echo '<td>'.$it['quantity'].'</td>';
    echo '<td>'.number_format($it['unit_price'],2).'</td>';
    echo '<td>'.number_format($sub,2).'</td>';
    echo '</tr>';
}
?>
</table>
<p><a href="view_orders.php">Back to Orders</a></p>
</div></body></html>
