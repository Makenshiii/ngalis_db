<?php include "../database.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $conn->query("DELETE FROM products WHERE product_id=$id");
}
header('Location: ../index.php');
exit;
?>