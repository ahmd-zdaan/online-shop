<?php
$cart_id = $_GET['cart_id'];
$page = $_GET['page'];

$query = "DELETE FROM cart WHERE cart_id=".$cart_id;

if (mysqli_query($connect, $query)) {
    if ($page == 'index') {
        echo "<script>window.location.href = 'index.php'</script>";
    } elseif ($page == 'cart') {
        echo "<script>window.location.href = 'index.php?page=cart_list'</script>";
    }
}
?>