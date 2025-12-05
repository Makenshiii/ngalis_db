<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Product</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$p = $conn->query("SELECT * FROM products WHERE product_id=$id");
if ($p->num_rows == 0) { echo '<p>Product not found. <a href="../index.php">Back</a></p>'; exit; }
$row = $p->fetch_assoc();
?>
<h2>Edit Product</h2>
<form method="POST">
    <div class="form-row">Name: <input type="text" name="name" value="<?php echo htmlspecialchars($row['product_name']); ?>" required></div>
    <div class="form-row">Price: <input type="number" name="price" step="0.01" value="<?php echo $row['price']; ?>" required></div>
    <div class="form-row">Stock: <input type="number" name="stock" value="<?php echo $row['stock_quantity']; ?>" required></div>
    <div class="form-row">Expiry Date: <input type="text" name="expiry_date" value="<?php echo htmlspecialchars($row['expiry_date']); ?>"></div>
    <div class="form-row">Category:
        <select name="category_id">
            <option value="">-- None --</option>
            <?php
            $cats = $conn->query("SELECT * FROM categories ORDER BY category_name");
            while ($c = $cats->fetch_assoc()) {
                $sel = ($c['category_id'] == $row['category_id']) ? 'selected' : '';
                echo '<option value="'.$c['category_id'].'" '.$sel.'>'.htmlspecialchars($c['category_name']).'</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-row"><button type="submit">Update</button> <a href="../index.php">Cancel</a></div>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];
    $expiry = !empty($_POST['expiry_date']) ? "'".$conn->real_escape_string($_POST['expiry_date'])."'" : "NULL";
    $cat = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : 'NULL';

    $sql = "UPDATE products SET product_name='$name', price=$price, stock_quantity=$stock, expiry_date=$expiry, category_id=$cat WHERE product_id=$id";
    if ($conn->query($sql)) {
        header('Location: ../index.php');
        exit;
    } else {
        echo '<p class="small">Error: '.$conn->error.'</p>';
    }
}
?>
</div></body></html>
