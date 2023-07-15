<?php
check('login');

$product_id = $_GET['product_id'];

$get_product = get('product', 'WHERE product_id='.$product_id);
$data_product = mysqli_fetch_assoc($get_product);

$product_name = $data_product['product_name'];
$seller_id = $data_product['seller_id'];

$email = $_SESSION['email'];

$get_user = get('user', 'WHERE email="'.$email.'"');
$data_user = mysqli_fetch_assoc($get_user);

$user_id = $data_user['user_id'];

$result = insert('discussion', [
    'product_id' => $product_id,
    'user_id' => $user_id,
    'seller_id' => $seller_id,
    'date' => date("d-m-Y")
]);

if ($result) {
    echo '<script>window.location.href = "https://api.whatsapp.com/send/?phone=085704801189&text='.$product_name.'"</script>';
}