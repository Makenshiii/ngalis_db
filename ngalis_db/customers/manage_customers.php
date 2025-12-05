<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Customers</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Customers</h2>
<a href="add_customer.php">+ Add Customer</a> | <a href="../index.php">Back to Products</a>
<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th></tr>
<?php
$res = $conn->query("SELECT * FROM customers ORDER BY name");
while ($r = $res->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$r['customer_id'].'</td>';
    echo '<td>'.htmlspecialchars($r['name']).'</td>';
    echo '<td>'.htmlspecialchars($r['email']).'</td>';
    echo '<td>'.htmlspecialchars($r['phone']).'</td>';
    echo '<td>'.htmlspecialchars($r['address']).'</td>';
    echo '<td><a href="edit_customer.php?id='.$r['customer_id'].'">Edit</a> | <a href="delete_customer.php?id='.$r['customer_id'].'" onclick="return confirm(\'Delete?\')">Delete</a></td>';
    echo '</tr>';
}
?>
</table>
</div></body></html>
