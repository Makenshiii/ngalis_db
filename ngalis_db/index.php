<?php include "database.php"; ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products - Semblante</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Products</h1>
    <div class="nav">
        <a href="products/add_product.php">+ Add Product</a>
        <a href="categories/manage_categories.php">Manage Categories</a>
        <a href="customers/manage_customers.php">Manage Customers</a>
        <a href="orders/view_orders.php">View Orders</a>
    </div>

    <table>
        <tr><th>ID</th><th>Product</th><th>Category</th><th>Price</th><th>Stock</th><th>Expiry</th><th>Actions</th></tr>
        <?php
        $sql = "SELECT p.*, c.category_name FROM products p LEFT JOIN categories c ON p.category_id = c.category_id ORDER BY p.product_id DESC";
        $res = $conn->query($sql);
        if ($res->num_rows == 0) {
            echo '<tr><td colspan="7">No products yet.</td></tr>';
        } else {
            while ($r = $res->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.htmlspecialchars($r['product_id']).'</td>';
                echo '<td>'.htmlspecialchars($r['product_name']).'</td>';
                echo '<td>'.htmlspecialchars($r['category_name']).'</td>';
                echo '<td>'.number_format($r['price'],2).'</td>';
                echo '<td>'.intval($r['stock_quantity']).'</td>';
                echo '<td>'.htmlspecialchars($r['expiry_date']).'</td>';
                echo '<td><a href="products/edit_product.php?id='.$r['product_id'].'">Edit</a> | <a href="products/delete_product.php?id='.$r['product_id'].'" onclick="return confirm(\'Delete this product?\')">Delete</a></td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</div>
</body>
</html>
