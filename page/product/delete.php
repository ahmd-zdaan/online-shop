<?php
$product_id = $_GET['product_id'];

$query = "DELETE FROM product WHERE product_id=".$product_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=product_list'</script>";
}
?>