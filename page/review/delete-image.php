<?php
$review_image_id = $_GET['review_image_id'];

$get_review_image = get('review_image', 'WHERE review_image_id=' . $review_image_id);
$data_review_image = mysqli_fetch_assoc($get_review_image);

$review_id = $data_review_image['review_id'];
$image_name = $data_review_image['image_name'];

$result = unlink("uploads/review/" . $image_name);

if ($result) {
    $query = "DELETE FROM review_image WHERE review_image_id=" . $review_image_id;
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=review_edit&review_id=" . $review_id . "'</script>";
    }
}
