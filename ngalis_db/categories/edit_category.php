<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Category</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$c = $conn->query("SELECT * FROM categories WHERE category_id=$id");
if ($c->num_rows == 0) { echo '<p>Not found. <a href="manage_categories.php">Back</a></p>'; exit; }
$row = $c->fetch_assoc();
?>
<h2>Edit Category</h2>
<form method="POST">
    <div class="form-row">Name: <input type="text" name="category_name" value="<?php echo htmlspecialchars($row['category_name']); ?>" required></div>
    <div class="form-row"><button type="submit">Update</button> <a href="manage_categories.php">Cancel</a></div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['category_name']);
    $conn->query("UPDATE categories SET category_name='$name' WHERE category_id=$id");
    header('Location: manage_categories.php'); exit;
}
?>
</div></body></html>
