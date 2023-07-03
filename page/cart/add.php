<?php
check('login');

if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
	$product_id = $_GET['product_id'];
	$quantity = $_GET['quantity'];
} else {
	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];
}

$user_email = $_SESSION['email'];
$result = get('user', 'WHERE email="' . $user_email . '"');
$data = mysqli_fetch_assoc($result);

$user_id = $data['user_id'];

$get_cart = get('cart', 'WHERE user_id=' . $user_id . ' AND product_id=' . $product_id);
if (mysqli_num_rows($get_cart) > 0) {
	$data_cart = mysqli_fetch_assoc($get_cart);

	$cart_quantity = $data_cart['quantity'];

	$query = 'UPDATE cart SET quantity="' . $cart_quantity + $quantity . '" WHERE product_id=' . $product_id;
	$result = mysqli_query($connect, $query);
} else {
	$result = insert('cart', [
		'user_id' => $user_id,
		'product_id' => $product_id,
		'quantity' => $quantity
	]);
}

if ($result) {
	echo '<script>window.location.href = "index.php?page=cart_list"</script>';
}
