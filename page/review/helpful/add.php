<?php
$email = $_SESSION['email'];
$user_get = get('user', 'WHERE email="' . $email . '"');
$user_table = mysqli_fetch_assoc($user_get);
$user_id = $user_table['user_id'];

$review_id = $_GET['review_id'];

$result = insert('review_helpful', [
	'user_id' => $user_id,
	'review_id' => $review_id
]);

$get_review = get('review', 'WHERE review_id='.$review_id);
$data_review = mysqli_fetch_assoc($get_review);
$product_id = $data_review['product_id'];

if ($result) {
	echo '<script>window.location.href = "index.php?page=product_view&product_id=' . $product_id . '"</script>';
}
?>