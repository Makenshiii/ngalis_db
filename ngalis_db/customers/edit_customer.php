<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Customer</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$c = $conn->query("SELECT * FROM customers WHERE customer_id=$id");
if ($c->num_rows == 0) { echo '<p>Not found. <a href="manage_customers.php">Back</a></p>'; exit; }
$row = $c->fetch_assoc();
?>
<h2>Edit Customer</h2>
<form method="POST">
    <div class="form-row">Name: <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required></div>
    <div class="form-row">Email: <input type="text" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"></div>
    <div class="form-row">Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>"></div>
    <div class="form-row">Address: <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>"></div>
    <div class="form-row"><button type="submit">Update</button> <a href="manage_customers.php">Cancel</a></div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $conn->query("UPDATE customers SET name='$name', email='$email', phone='$phone', address='$address' WHERE customer_id=$id");
    header('Location: manage_customers.php'); exit;
}
?>
</div></body></html>
