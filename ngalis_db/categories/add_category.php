<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Add Category</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Add Category</h2>
<form method="POST">
    <div class="form-row">Name: <input type="text" name="category_name" required></div>
    <div class="form-row"><button type="submit">Save</button> <a href="manage_categories.php">Cancel</a></div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['category_name']);
    $conn->query("INSERT INTO categories (category_name) VALUES ('$name')");
    header('Location: manage_categories.php');
    exit;
}
?>
</div></body></html>
