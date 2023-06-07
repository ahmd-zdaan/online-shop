<?php
$result = get('user', 'WHERE email="' . $email . '"');
$data = mysqli_fetch_assoc($result);
$user_id = $data['user_id'];

$query = "DELETE FROM cart WHERE user_id=".$user_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=cart_list'</script>";
}
