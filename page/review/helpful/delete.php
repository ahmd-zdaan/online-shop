<?php
$review_id = $_GET['review_id'];

$query = "DELETE FROM review_helpful WHERE review_id=".$review_id;
$result = mysqli_query($connect, $query);

$get_review = get('review', 'WHERE review_id='.$review_id);
$data_review = mysqli_fetch_assoc($get_review);
$product_id = $data_review['product_id'];

if ($result) {
    echo "<script>window.location.href = 'index.php?page=product_view&product_id=".$product_id."'</script>";
}
?>