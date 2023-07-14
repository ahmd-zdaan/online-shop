<?php
check('login');

$product_id = $_GET['product_id'];

$get_image = get('product_image', 'WHERE product_id='.$product_id);
foreach ($get_image as $data_image) {
    $image_name = $data_image['image_name'];

    unlink("uploads/product/" . $image_name);
}

$query = "DELETE FROM product WHERE product_id=".$product_id;
$result = mysqli_query($connect, $query);

if ($result) {
    echo "<script>window.location.href = 'index.php?page=seller_product'</script>";
}
?>