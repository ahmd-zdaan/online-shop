<?php
$user_id = $_GET['user_id'];

$get_cart = get('cart', 'WHERE user_id=' . $user_id);

foreach ($get_cart as $data_cart) {
    $product_id = $data_cart['product_id'];
    $quantity = $data_cart['quantity'];

    $query = "DELETE FROM cart WHERE product_id=" . $product_id;
    $delete_cart = mysqli_query($connect, $query);

    if ($delete_cart) {
        $get_product = get('product', 'WHERE product_id=' . $product_id);
        $data_product  = mysqli_fetch_assoc($get_product);

        $sold = $data_product['sold'];
        $sold = (int)$sold + (int)$quantity;

        $query = 'UPDATE product SET sold=' . $sold . ' WHERE product_id=' . $product_id;
        $product_sold = mysqli_query($connect, $query);

        if ($product_sold) {
            $product_history = insert('history', [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'date' => date("d-m-Y")
            ]);

            if ($product_history) {
                echo "<script>window.location.href = 'index.php?page=cart_list'</script>";
            }
        }
    }
}
