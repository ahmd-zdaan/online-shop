<?php
$review_report_id = $_GET['review_report_id'];

$get_report = get('review_report', 'WHERE review_report_id='.$review_report_id);
$data_report = mysqli_fetch_assoc($get_report);

$review_id = $data_report['review_id'];

$get_review = get('review', 'WHERE review_id='.$review_id);
$data_review = mysqli_fetch_assoc($get_review);

$report = $data_review['report'];

$query = 'UPDATE review SET report=' . $report + 1 . ' WHERE review_id=' . $review_id;
$result = mysqli_query($connect, $query);

if ($result) {
    $query = 'DELETE FROM review_report WHERE review_report_id='.$review_report_id;
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo '<script>window.location.href = "index.php?page=report_review_list"</script>';
    }
}