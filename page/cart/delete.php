<?php
$product_id = $_GET['product_id'];

$email = $_SESSION['email'];
$get_user = get('user', 'WHERE email="'.$email.'"');
$data_user = mysqli_fetch_assoc($get_user);
$user_id = $data_user['user_id'];

$query = "DELETE FROM cart WHERE user_id=".$user_id." AND product_id=".$product_id;
$result = mysqli_query($connect, $query);

if ($result) {
    echo "<script>window.location.href='index.php?page=cart_list'</script>";
}
?>