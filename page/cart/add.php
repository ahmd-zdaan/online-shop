<?php
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$user_email = $_SESSION['email'];
$result = get('user', 'WHERE email="'.$user_email.'"');
$data = mysqli_fetch_assoc($result);

$user_id = $data['user_id'];

$result = insert('cart', [
	'user_id' => $user_id,
	'product_id' => $product_id,
	'quantity' => $quantity
]);

if ($result) {
	echo '<script>window.location.href = "index.php?page=cart_list"</script>';
}
?>