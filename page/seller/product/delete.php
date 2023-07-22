<?php
check('login');

$product_id = $_GET['product_id'];

$get_image = get('product_image', 'WHERE product_id=' . $product_id);
foreach ($get_image as $data_image) {
    $image_name = $data_image['image_name'];

    $delete_product_image = unlink("uploads/product/" . $image_name);
    var_dump($delete_product_image);
}

if ($delete_product_image) {
    $delete_wishlist = mysqli_query($connect, "DELETE FROM wishlist WHERE product_id=" . $product_id);

    if ($delete_wishlist) {
        $delete_product = mysqli_query($connect, "DELETE FROM product WHERE product_id=" . $product_id);

        if ($delete_product) {
            echo "<script>window.location.href = 'index.php?page=seller_product'</script>";
        }
    }
}