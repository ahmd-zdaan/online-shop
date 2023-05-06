<?php
check('login');

$product_id = $_GET['product_id'];

$query = get('product_image', 'WHERE product_id='.$product_id);
$data = mysqli_fetch_assoc($query);
$image_name = $data['image_name'];
unlink("uploads/" . $image_name);

$query = "DELETE FROM product WHERE product_id=".$product_id;

if (mysqli_query($connect, $query)) {
    echo "<script>window.location.href = 'index.php?page=product_list'</script>";
}
?>