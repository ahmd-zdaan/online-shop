<?php
$cart_id = $_GET['cart_id'];

$query = "DELETE FROM cart WHERE cart_id=".$cart_id;
$result = mysqli_query($connect, $query);

if ($result) {
    echo "<script>window.location.href='index.php?page=cart_list'</script>";
}
?>