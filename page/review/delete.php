<?php
$review_id = $_GET['review_id'];
$product_id = $_GET['product_id'];

$query = "DELETE FROM review WHERE review_id=".$review_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=product_view&product_id=".$product_id."'</script>";
}
?>