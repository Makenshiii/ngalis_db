<?php include "../database.php"; ?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Add Product</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Add Product</h2>
<form method="POST">
    <div class="form-row">Name: <input type="text" name="name" required></div>
    <div class="form-row">Price: <input type="number" name="price" step="0.01" required></div>
    <div class="form-row">Stock: <input type="number" name="stock" required></div>
    <div class="form-row">Expiry Date: <input type="text" name="expiry_date" placeholder="YYYY-MM-DD"></div>
    <div class="form-row">Category:
        <select name="category_id">
            <option value="">-- None --</option>
            <?php
            $cats = $conn->query("SELECT * FROM categories ORDER BY category_name");
            while ($c = $cats->fetch_assoc()) {
                echo '<option value="'.$c['category_id'].'">'.htmlspecialchars($c['category_name']).'</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-row"><button type="submit">Save</button> <a href="../index.php">Cancel</a></div>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $expiry = !empty($_POST['expiry_date']) ? $conn->real_escape_string($_POST['expiry_date']) : null;
    $cat = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : 'NULL';

    $sql = "INSERT INTO products (product_name, price, stock_quantity, expiry_date, category_id)
            VALUES ('$name', $price, $stock, ".($expiry ? "'$expiry'" : "NULL").", $cat)";
    if ($conn->query($sql)) {
        header('Location: ../index.php');
        exit;
    } else {
        echo '<p class="small">Error: '.$conn->error.'</p>';
    }
}
?>
</div></body></html>
