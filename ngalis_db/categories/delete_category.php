<?php include "../database.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
    $conn->query("DELETE FROM categories WHERE category_id=$id");
}
header('Location: manage_categories.php');
exit;
?>