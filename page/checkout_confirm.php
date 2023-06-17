<?php
$result = get('user', 'WHERE email="' . $email . '"');
$data = mysqli_fetch_assoc($result);
$user_id = $data['user_id'];

// SOLD
$cart_get = get('cart', 'WHERE user_id=' . $user_id . ' GROUP BY product_id', '*,SUM(quantity) AS total_quantity');

foreach ($cart_get as $data) {
    $product_id = $data['product_id'];
    $total_quantity = $data['total_quantity'];

    $product_get = get('product', 'WHERE product_id=' . $product_id);
    $product_data = mysqli_fetch_assoc($product_get);

    $sold_old = $product_data['sold'];
    $sold_new = $sold_old + $total_quantity;

    $query = 'UPDATE product SET sold="' . $sold_new . '" WHERE product_id=' . $product_id;
    mysqli_query($connect, $query);
}

// HISTORY
$result = insert('history', [
    'user_id' => $user_id,
    'product_id' => $product_id,
    'date' => date("d-m-Y")
]);

if ($result) {
    $query = "DELETE FROM cart WHERE user_id=" . $user_id;

    if (mysqli_query($connect, $query)) {
        echo "<script>window.location.href = 'index.php?page=cart_list'</script>";
    }
}
