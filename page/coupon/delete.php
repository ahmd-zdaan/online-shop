<?php
$coupon_id = $_GET['coupon_id'];

$query = "DELETE FROM coupon WHERE coupon_id=".$coupon_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=coupon_list'</script>";
}
?>