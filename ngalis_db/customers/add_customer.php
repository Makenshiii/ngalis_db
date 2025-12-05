<?php include "../database.php"; ?>
<!doctype html><html><head><meta charset="utf-8"><title>Add Customer</title><link rel="stylesheet" href="../style.css"></head><body>
<div class="container">
<h2>Add Customer</h2>
<form method="POST">
    <div class="form-row">Name: <input type="text" name="name" required></div>
    <div class="form-row">Email: <input type="text" name="email"></div>
    <div class="form-row">Phone: <input type="text" name="phone"></div>
    <div class="form-row">Address: <input type="text" name="address"></div>
    <div class="form-row"><button type="submit">Save</button> <a href="manage_customers.php">Cancel</a></div>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $conn->query("INSERT INTO customers (name,email,phone,address) VALUES ('$name','$email','$phone','$address')");
    header('Location: manage_customers.php'); exit;
}
?>
</div></body></html>
