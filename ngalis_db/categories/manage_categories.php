<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Categories</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Categories</h2>
<a href="add_category.php">+ Add Category</a> | <a href="../index.php">Back to Products</a>
<table>
<tr><th>ID</th><th>Name</th><th>Actions</th></tr>
<?php
$res = $conn->query("SELECT * FROM categories ORDER BY category_name");
while ($r = $res->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$r['category_id'].'</td>';
    echo '<td>'.htmlspecialchars($r['category_name']).'</td>';
    echo '<td><a href="edit_category.php?id='.$r['category_id'].'">Edit</a> | <a href="delete_category.php?id='.$r['category_id'].'" onclick="return confirm(\'Delete?\')">Delete</a></td>';
    echo '</tr>';
}
?>
</table>
</div></body></html>
