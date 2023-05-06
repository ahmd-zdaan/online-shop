<?php
$user_email = $_SESSION['email'];
$result = get('user', 'WHERE email="'.$user_email.'"');
$data = mysqli_fetch_assoc($result);

$user_id = $data['user_id'];

$product_id = $_GET['product_id'];

insert('wishlist', [
	'user_id' => $user_id,
	'product_id' => $product_id
]);

echo "<script>window.location.href = 'index.php?page=wishlist_list'</script>";