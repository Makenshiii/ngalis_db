<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Create Order</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Create Order</h2>
<form method="POST">
    <div class="form-row">Customer:
    <select name="customer_id" required>
        <option value="">-- select --</option>
        <?php
        $cs = $conn->query("SELECT * FROM customers ORDER BY name");
        while ($c = $cs->fetch_assoc()) {
            echo '<option value="'.$c['customer_id'].'">'.htmlspecialchars($c['name']).'</option>';
        }
        ?>
    </select>
    </div>

    <h3>Products</h3>
    <?php
    $ps = $conn->query("SELECT * FROM products ORDER BY product_name");
    while ($p = $ps->fetch_assoc()) {
        echo '<div class="form-row">';
        echo '<input type="checkbox" name="product_id[]" value="'.$p['product_id'].'"> '.htmlspecialchars($p['product_name']).' ('.number_format($p['price'],2).') ';
        echo 'Qty: <input type="number" name="qty_'.$p['product_id'].'" min="1" style="width:60px">';
        echo '</div>';
    }
    ?>

    <div class="form-row"><button type="submit">Create Order</button> <a href="view_orders.php">Cancel</a></div>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = (int)$_POST['customer_id'];
    $conn->query("INSERT INTO orders (customer_id, total_amount) VALUES ($customer_id, 0)");
    $order_id = $conn->insert_id;
    $total = 0.0;

    if (!empty($_POST['product_id'])) {
        foreach ($_POST['product_id'] as $pid) {
            $pid = (int)$pid;
            $qty = isset($_POST['qty_'.$pid]) ? (int)$_POST['qty_'.$pid] : 1;
            if ($qty <= 0) $qty = 1;
            $p = $conn->query("SELECT price, stock_quantity FROM products WHERE product_id=$pid")->fetch_assoc();
            if (!$p) continue;
            $price = (float)$p['price'];
            $subtotal = $price * $qty;
            $total += $subtotal;
            $conn->query("INSERT INTO order_items (quantity, unit_price, order_id, product_id) VALUES ($qty, $price, $order_id, $pid)");
            // reduce stock (optional)
            $conn->query("UPDATE products SET stock_quantity = stock_quantity - $qty WHERE product_id=$pid");
        }
    }

    $conn->query("UPDATE orders SET total_amount=$total WHERE order_id=$order_id");
    header('Location: view_orders.php');
    exit;
}
?>
</div></body></html>
