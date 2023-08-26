<?php
include_once 'config/connect.php';

$email = $_SESSION['email'];
$get_user = get('user', 'WHERE email="' . $email . '"');
$data_user = mysqli_fetch_assoc($get_user);
$user_id = $data_user['user_id'];

$shipping_price = $_GET['shipping_price'];
$subtotal_price = $_GET['subtotal_price'];
$gross = $_GET['gross'];

insert('transaction', [
    'user_id' => $user_id,
    'shipping_price' => $shipping_price,
    'subtotal_price' => $subtotal_price,
    'gross' => $gross,
    'date' => date("d-m-Y")
]);

$last_id = mysqli_insert_id($connect);

$get_cart = get('cart', 'WHERE user_id=' . $user_id);
foreach ($get_cart as $data_cart) {
    $product_id = $data_cart['product_id'];
    $quantity = $data_cart['quantity'];

    $get_product = get('product', 'WHERE product_id=' . $product_id);
    $data_product = mysqli_fetch_assoc($get_product);

    $get_sale = get('sale', 'WHERE product_id=' . $product_id);
    if (mysqli_num_rows($get_sale) > 0) {
        $data_sale = mysqli_fetch_assoc($get_sale);
        $sale = $data_sale['sale'];
        $price = $price - $price * (int)$sale / 100;
    } else {
        $price = $data_product['price'];
    }

    insert('transaction_details', [
        'transaction_id' => $last_id,
        'product_id' => $product_id,
        'price' => $price,
        'quantity' => $quantity
    ]);

    $sold = $data_product['sold'];
    $sold = (int)$sold + (int)$quantity;

    $query = 'UPDATE product SET sold=' . $sold . ' WHERE product_id=' . $product_id;
    mysqli_query($connect, $query);

    $query = 'UPDATE user SET purchased=' . $sold . ' WHERE user_id=' . $user_id;
    mysqli_query($connect, $query);

    $query = "DELETE FROM cart WHERE product_id=" . $product_id . " AND user_id=" . $user_id;
    mysqli_query($connect, $query);

    $query = "DELETE FROM wishlist WHERE product_id=" . $product_id . " AND user_id=" . $user_id;
    mysqli_query($connect, $query);
}

echo "<script>window.location.href = 'index.php?page=transaction_list'</script>";
