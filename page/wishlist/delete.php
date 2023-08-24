<?php
$user_email = $_SESSION['email'];
$get_user = get('user', 'WHERE email="' . $user_email . '"');
$data_user = mysqli_fetch_assoc($get_user);
$user_id = $data_user['user_id'];

$product_id = $_GET['product_id'];

$query = 'DELETE FROM wishlist WHERE user_id=' . $user_id . ' AND product_id=' . $product_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=wishlist_list'</script>";
}
