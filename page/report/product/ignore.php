<?php
$product_report_id = $_GET['product_report_id'];

$query = "DELETE FROM product_report WHERE product_report_id=".$product_report_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=report_product_list'</script>";
}
?>