<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Orders</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Orders</h2>
<a href="create_order.php">+ Create New Order</a> | <a href="../index.php">Back to Products</a>
<table>
<tr><th>ID</th><th>Customer</th><th>Total Items</th><th>Total Amount</th><th>Order Date</th><th>Action</th></tr>
<?php
$sql = "SELECT o.order_id, o.order_date, o.total_amount, CONCAT(c.name) AS customer,
        (SELECT IFNULL(SUM(quantity),0) FROM order_items WHERE order_id=o.order_id) AS items
        FROM orders o LEFT JOIN customers c ON c.customer_id = o.customer_id ORDER BY o.order_id DESC";
$res = $conn->query($sql);
while ($r = $res->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$r['order_id'].'</td>';
    echo '<td>'.htmlspecialchars($r['customer']).'</td>';
    echo '<td>'.$r['items'].'</td>';
    echo '<td>'.number_format($r['total_amount'],2).'</td>';
    echo '<td>'.$r['order_date'].'</td>';
    echo '<td><a href="view_order_details.php?id='.$r['order_id'].'">View</a></td>';
    echo '</tr>';
}
?>
</table>
</div></body></html>
