<?php
$user_id = $_GET['user_id'];

$get_cart = get('cart', 'WHERE user_id=' . $user_id);

foreach ($get_cart as $data_cart) {
    $product_id = $data_cart['product_id'];
    $quantity = $data_cart['quantity'];

    $query = "DELETE FROM cart WHERE product_id=" . $product_id;
    $result = mysqli_query($connect, $query);

    if ($result) {
        $get_product = get('product', 'WHERE product_id=' . $product_id);
        $data_product  = mysqli_fetch_assoc($get_product);

        $sold = $data_product['sold'];
        $sold = (int)$sold + (int)$quantity;

        $query = 'UPDATE product SET sold=' . $sold . ' WHERE product_id=' . $product_id;
        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "<script>window.location.href = 'index.php?page=cart_list'</script>";
        }
    }
}
