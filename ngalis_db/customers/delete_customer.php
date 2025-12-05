<?php include "../database.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $conn->query("DELETE FROM customers WHERE customer_id=$id");
}
header('Location: manage_customers.php');
exit;
?>