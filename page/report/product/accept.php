<?php
$product_report_id = $_GET['product_report_id'];

$get_report = get('product_report', 'WHERE product_report_id='.$product_report_id);
$data_report = mysqli_fetch_assoc($get_report);

$product_id = $data_report['product_id'];

$get_product = get('product', 'WHERE product_id='.$product_id);
$data_product = mysqli_fetch_assoc($get_product);

$report = $data_product['report'];

$query = 'UPDATE product SET report=' . $report + 1 . ' WHERE product_id=' . $product_id;
$result = mysqli_query($connect, $query);

if ($result) {
    $query = "DELETE FROM product_report WHERE product_report_id=".$product_report_id;
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=report_product_list'</script>";
    }
}